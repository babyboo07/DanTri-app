<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\PostComment;
use App\Models\ShortVideo;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('users as author', 'author.id',  'posts.author_id')
            ->join('categories as c', 'c.id', 'posts.cate_id')
            ->leftJoin('users as approved', 'approved.id', 'posts.approved_id')->orderBy('created_date', 'desc')->sortable()
            ->select('posts.*', 'author.name AS author_name', 'approved.name AS approved_name', "c.cateName")
            ->paginate(5);

        $author = User::where('role_id', 3)->get();
        $approved = User::where('role_id', 4)->get();

        return view('admin.post.index', compact('posts', 'author', 'approved'));
    }

    public function search(Request $request)
    {
        $posts = Post::join('users as author', 'author.id',  'posts.author_id')
            ->join('categories as c', 'c.id', 'posts.cate_id')
            ->leftJoin('users as approved', 'approved.id', 'posts.approved_id')
            ->where('posts.status', $request->status)
            ->orWhere('posts.title', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('posts.author_id', $request->author_id)
            ->orWhere('posts.approved_id', $request->approved_id)
            ->orWhereBetween('posts.created_date', [$request->created_date, Carbon::now()])
            ->select('posts.*', 'author.name AS author_name', 'approved.name AS approved_name', "c.cateName")
            ->paginate(5);

        $author = User::where('role_id', 3)->get();

        $approved = User::where('role_id', 4)->get();
        // dd($posts);
        return view('admin.post.index', compact('posts', 'author', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where("parent_id", null)
            ->where("status", 1)
            ->get();

        return view('admin.post.create', compact('categories'));
    }

    public function getCateParent()
    {
        $categories = Category::where("parent_id", null)->where("status", 1)->get();
        return response()->json($categories);
    }

    public function getCateAll()
    {
        $categories = Category::where("status", 1)->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'thumbnail' => ['required'],
            'created_date' => ['required'],
            'cate_id' => ['required']
        ]);
        // dd($request);
        $post = new Post();
        $img = "";
        if ($request->hasFile('thumbnail')) {
            // $this->validate(
            //     $request,
            //     [
            //         'thumbnail' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            //     ],
            // );
            $thumbnail = $request->file('thumbnail');
            $getimg = $thumbnail->getClientOriginalName();
            $destinationPath = public_path('storage/post');
            $thumbnail->move($destinationPath, $getimg);
            $img = $getimg;
        }
        $content = $request->content;
        $shortContent = $request->shortContent;

        $dom2 = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom2->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $shortContent);
        libxml_use_internal_errors(false);

        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);
        libxml_use_internal_errors(false);


        $imageFile = $dom->getElementsByTagName('img');
        // dd($imageFile);

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/storage/posts/" . time() . $item . '.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $imgeData);

            $files[] = $image_name;

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();
        $content = html_entity_decode($content);

        $shortContent = $dom2->saveHTML();
        $shortContent = html_entity_decode($shortContent);

        $post->title = $request->title;
        $post->shortContent = $shortContent;
        $post->created_date = $request->created_date;
        $post->content = $content;
        $post->thumbnail = $img;
        $post->status = $request->status;
        $post->author_id = $request->author_id;
        $post->cate_id = $request->cate_id;
        $post->save();



        return redirect('/post')->with('success', 'Posts Has Been updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')
            ->rightJoin('users', 'users.id', '=', 'posts.author_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.cate_id')
            ->where('posts.id', $id)
            ->select('posts.*', 'users.name AS author_name', 'categories.cateName')
            ->first();

        $pC = DB::table('post_comments')
            ->leftJoin('users', 'users.id', '=', 'post_comments.approved_id')
            ->where('post_id', $id)
            ->select('users.name as approved_name', 'post_comments.*')
            ->get();

        return view('admin.post.detail', compact('post', 'pC'));
    }

    public function updateStatus($id, Request $request)
    {
        $post = Post::findOrFail($id);
        $post->status = $request->get('status');
        $post->hot = $request->get('hot');
        $post->approved_id = $request->get('approved_id');
        $post->approved_date = new DateTime('now');
        $post->save();
        return  redirect('/post')->with('success', 'Posts Has Been updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $categories = Category::where("parent_id", null)
            ->where("status", 1)
            ->get();

        $post = Post::findOrFail($id);

        $pC = DB::table('post_comments')
            ->leftJoin('users', 'users.id', '=', 'post_comments.approved_id')
            ->where('post_id', $id)
            ->select('users.name as approved_name', 'post_comments.*')
            ->get();
        // dd($pC);
        return view('admin.post.edit', compact('categories', 'post', 'pC'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'cate_id' => ['required'],
            'status' => ['required'],
        ]);
        // dd($request);
        $post = Post::findOrFail($id);

        $img = "";
        if ($request->hasFile('thumbnail')) {
            // $this->validate(
            //     $request,
            //     [
            //         'thumbnail' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            //     ],
            // );
            $thumbnail = $request->file('thumbnail');
            $getimg = $thumbnail->getClientOriginalName();
            $destinationPath = public_path('storage/post');
            $thumbnail->move($destinationPath, $getimg);
            $img = $getimg;
        }
        $content = $request->content;
        $shortContent = $request->shortContent;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);

        $imageFile = $dom->getElementsByTagName('img');
        // dd($imageFile);

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/storage/posts/" . time() . $item . '.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $imgeData);

            $files[] = $image_name;

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();
        $content = html_entity_decode($content);


        $shortContent = $this->convertToHtml($shortContent);
        //dd($shortContent);
        $post->title = $request->title;
        $post->shortContent = $shortContent;
        $post->status = $request->status;
        $post->content = $content;

        $filename = 'storage/post/' . $post->thumbnail;
        if ($request->hasFile('thumbnail')) {
            unlink($filename);
            $post->thumbnail = $img;
        }
        $post->cate_id = $request->cate_id;
        $post->save();

        return redirect('/post')->with('success', 'Posts Has Been updated successfully');
    }

    private function convertToHtml($text)
    {
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $message  = mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8');
        $dom->loadHtml($message);
        return $dom->saveHTML();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        return redirect('/post')->with('success', 'Posts Has Been updated successfully');
    }


    public function newsDetail($id)
    {
        $post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author_id')
            ->join('categories', 'categories.id', '=', 'posts.cate_id')
            ->where('posts.id', $id)
            ->select('posts.*', 'users.name AS author_name', 'categories.cateName', 'categories.parent_id as category_id')
            ->first();
        $parentCate = Category::where('id', $post->category_id)->first();

        $postRelate = Post::where('status', 2)
            ->where('hot', null)
            ->where('cate_id', $post->cate_id)
            ->orderBy('created_date', 'desc')->take(2)->get();

        $mostPopular = Post::where('cate_id', $post->cate_id)
            ->orderBy('view', 'desc')->take(5)->get();
        // dd($mostPopular);

        $commentOfPost = Comment::where('post_id', $id)
            ->where('comments.status', 1)
            ->where('comments.reply_id', null)
            ->join('users as u', 'u.id', 'comments.user_id')
            ->orderBy('comment_date', 'desc')
            ->select('comments.*', 'u.name as userName')->get();

        $commentCount = Comment::where('post_id', $id)
            ->where('status', 1)
            ->orWhere('reply_id', $id)
            ->get();
        // $likeCount = Comment::where('post_id', $id)

        return view('client.newsdetail', compact('post', 'parentCate', 'postRelate', 'id', 'mostPopular', 'commentOfPost', 'commentCount'));
    }

    public function increaseViews($id)
    {
        $view = Post::find($id);
        $view->view = $view->view + 1;
        $view->save();
        return response()->json($view);
    }

    public function sreachByCategory($id)
    {
        $conditions = [
            ['status', 2],
            ['hot', null],
        ];

        $category = Category::where('id', $id)->first();

        $parent = $category->children()->pluck('id')->toArray();

        $hotArticles = Post::where("hot", 1)
            ->where('status', 2)
            ->whereIn('cate_id', $parent)
            ->orderBy('created_date', 'desc')
            ->take(3)
            ->get();
        // dd($hotArticles);

        $articleCol = Post::where($conditions)
            ->whereIn('cate_id', $parent)
            ->orderBy('created_date', 'desc')->take(4)->get();

        // dd($articleCol);

        $allArticle = Post::where($conditions)
            ->whereIn('cate_id', $parent)
            ->orderBy('created_date', 'desc')->paginate(5);
        // dd($allArticle);

        $videoHot = ShortVideo::where("hot", 1)
            ->where('status', 2)
            ->whereIn('cate_id', $parent)
            ->orderBy('created_at', 'desc')
            ->first();
        // dd($videoHot);

        $listVideo = ShortVideo::where($conditions)
            ->whereIn('cate_id', $parent)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($listVideo);

        return view('client.sreachbycate', compact('category', 'hotArticles', 'articleCol', 'allArticle', 'videoHot', 'listVideo'));
    }
}
