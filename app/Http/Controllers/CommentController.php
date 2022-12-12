<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
        $comment = Comment::join('posts as p', 'p.id', 'comments.post_id')
            // ->join('short_videos as v', 'v.id', 'comments.video_id')
            ->join('users as u', 'u.id', 'comments.user_id')
            ->leftJoin('users as u1', 'u1.id', 'comments.approved_id')->sortable()
            ->orderBy('comment_date', 'desc')
            ->select('comments.*', 'p.title', 'u.name as userName', 'u1.name as approved_name')
            ->paginate(5);
        // dd($comment);
        return view('admin.comment.index', compact('comment'));
    }

    public function commentOfVideo()
    {
        $comment = Comment::join('short_videos as v', 'v.id', 'comments.video_id')
            ->join('users as u', 'u.id', 'comments.user_id')
            ->leftJoin('users as u1', 'u1.id', 'comments.approved_id')->sortable()
            ->orderBy('comment_date', 'desc')
            ->select('comments.*', 'v.title', 'u.name as userName', 'u1.name as approved_name')
            ->paginate(5);
        // dd($comment);

        return view('admin.video.comment', compact('comment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $comment->comment_date = new DateTime('now');
        $comment->status = null;
        $comment->post_id = $request->get('post_id');

        if ($request->reply_id) {
            $comment->reply_id = $request->get('reply_id');
        }
        $comment->save();


        $route = '/news/detail/' . $request->get('post_id');
        return redirect($route)->with('status', "succesfully created");
    }

    public function createCommentOfVideo(Request $request)
    {

        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $comment->comment_date = new DateTime('now');
        $comment->status = null;
        $comment->video_id = $request->get('video_id');

        if ($request->reply_id) {
            $comment->reply_id = $request->get('reply_id');
        }
        $comment->save();

        $route = '/video/detail/' . $request->get('video_id');
        return redirect($route)->with('status', "succesfully created");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = DB::table('Comments as c')
            ->join('posts as p', 'p.id', 'c.post_id')
            ->join('users as u', 'u.id', 'c.user_id')
            ->leftJoin('users as u1', 'u1.id', 'c.approved_id')
            ->where('c.id', $id)
            ->select('c.*', 'p.title', 'p.shortContent', 'u.name as username', 'u1.name as approvedName')
            ->first();
        $reply =  Comment::where('id', $comment->reply_id)->first();
        // dd($comment);
        return view('admin.comment.detail', compact('comment', 'reply'));
    }


    public function showVideoComment($id)
    {
        $comment = DB::table('Comments as c')
            ->join('short_videos as s', 's.id', 'c.video_id')
            ->join('users as u', 'u.id', 'c.user_id')
            ->leftJoin('users as u1', 'u1.id', 'c.approved_id')
            ->where('c.id', $id)
            ->select('c.*', 's.title', 's.description','s.link', 'u.name as username', 'u1.name as approvedName')
            ->first();
        $reply =  Comment::where('id', $comment->reply_id)->first();

        return view('admin.video.commentDetail', compact('comment', 'reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id)->delete();
        return redirect('/comment');
    }

    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->status = $request->get('status');
        $comment->approved_id = Auth::user()->id;
        $comment->approved_date = new DateTime('now');
        $comment->save();
        return redirect('/comment');
    }

    public function likeComment($id)
    {
        $comment = Comment::find($id);
        $likedUsers = $comment->like_id ?? [];
        $userLikedId = Auth::user()->id;
        $indexOf = array_search($userLikedId, $likedUsers);
        // if existed user then remove
        if ($indexOf !== false) {
            unset($likedUsers[$indexOf]);
        } else {
            $likedUsers[] = $userLikedId;
        }

        $comment->like_id = $likedUsers;
        $comment->save();

        return response()->json([
            'status'    => 1,
            'message' => 'Like done'
        ]);
    }
}
