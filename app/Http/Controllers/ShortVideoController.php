<?php

namespace App\Http\Controllers;

use App\Models\ShortVideo;
use App\Http\Requests\StoreShortVideoRequest;
use App\Http\Requests\UpdateShortVideoRequest;
use App\Models\Category;
use App\Models\Comment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class ShortVideoController extends Controller
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
        $video = DB::table('short_videos as sv')
            ->leftJoin('categories as c', "c.id", "sv.cate_id")
            ->leftJoin('users as u', "u.id", "sv.author_id")
            ->leftJoin('users as u2', "u2.id", "sv.approved_id")->orderBy('created_at', 'desc')
            ->select('sv.*', 'c.cateName', 'u.name as author_name', 'u2.name as approved_name')->paginate(8);
        return view('admin.video.index', compact('video'));
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
        return view('admin.video.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShortVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = new ShortVideo();
        $video->link = $request->get('videoID');
        $video->title = $request->get('title');
        $video->thumbnail = $request->get('thumbnail');
        $video->cate_id = $request->get('cate_id');
        $video->status = $request->get('status');
        $video->kind = $request->get('kind');
        $video->description = $request->get('description');
        $video->author_id = Auth::user()->id;
        $video->save();
        return redirect('/video')->with('success', 'Video successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortVideo  $shortVideo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = DB::table('short_videos as sv')
            ->leftJoin('categories as c', "c.id", "sv.cate_id")
            ->leftJoin('users as u', "u.id", "sv.author_id")
            ->where('sv.id', $id)
            ->select('sv.*', 'c.cateName', 'u.name as author_name')->first();
        return view('admin.video.detail', compact('video'));
    }


    public function updateStatus($id, Request $request)
    {
        $video = ShortVideo::findOrFail($id);
        $video->approved_id = Auth::user()->id;
        $video->hot = $request->get('hot');
        $video->status = $request->get('status');
        $video->approved_date = new DateTime('now');
        $video->save();
        return redirect('/video')->with('success', 'Video have been updated');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShortVideo  $shortVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortVideo $shortVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShortVideoRequest  $request
     * @param  \App\Models\ShortVideo  $shortVideo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShortVideoRequest $request, ShortVideo $shortVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortVideo  $shortVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = ShortVideo::findOrFail($id)->delete();
        return redirect('/video')->with('success', 'Video deleted successfully');
    }

    public function details($id)
    {
        $video = DB::table('short_videos as s')->where('s.id', $id)
            ->join('categories as c', 'c.id', 's.cate_id')
            ->select('s.*', 'c.cateName')->first();

        $listVideo = DB::table('short_videos as s')->where('kind', 1)
            ->join('categories as c', 'c.id', 's.cate_id')
            ->orderBy('created_at', 'desc')
            ->select('s.*', 'c.cateName')->get();
        // dd($listVideo);

        $comment = DB::table('comments')->where('video_id', $id)
            ->join('users as u', 'u.id', 'comments.user_id')
            ->where('status', 1)
            ->orderBy('comment_date', 'desc')
            ->select('comments.*', 'u.name as userName')->get();

        $commentCount = Comment::where('video_id', $id)
            ->where('status', 1)
            ->orWhere('reply_id', $id)
            ->get();
        // dd($comment);
        return view('client.videoDetail', compact('video', 'listVideo', 'comment', 'commentCount'));
    }


    public function shortVideo($id)
    {
        $video = ShortVideo::where('short_videos.id', $id)
            ->join('categories as c', 'c.id', 'short_videos.cate_id')
            ->leftJoin('comments as c1', 'c1.video_id', 'short_videos.id')
            ->where('short_videos.kind', 2)
            ->where('short_videos.status', 2)
            ->orderBy('short_videos.created_at', 'desc')
            ->select('short_videos.*', 'c.cateName', 'c1.id as commentID')
            ->first();
        // dd($video);

        $listVideo = ShortVideo::join('categories as c', 'c.id', 'short_videos.cate_id')
            ->leftJoin('comments as c1', 'c1.video_id', 'short_videos.id')
            ->where('short_videos.kind', 2)
            ->where('short_videos.status', 2)
            ->orderBy('short_videos.created_at', 'desc')
            ->select('short_videos.*', 'c.cateName', 'c1.id as commentID')
            ->get();

        // dd($shortVideo);

        $comment = Comment::where('video_id', $id)->where('status', 1)->get();
        // dd($comment);

        return view('client.shortVideoDetail', compact('listVideo', 'video','comment'));
    }


    public function likeVideo($id)
    {
        $video = ShortVideo::find($id);
        $likedUsers = $video->like_id ?? [];
        $userLikedId = Auth::user()->id;
        $indexOf = array_search($userLikedId, $likedUsers);
        // if existed user then remove
        if ($indexOf !== false) {
            unset($likedUsers[$indexOf]);
        } else {
            $likedUsers[] = $userLikedId;
        }

        $video->like_id = $likedUsers;
        $video->save();

        return response()->json([
            'status'    => 1,
            'message' => 'Like done'
        ]);
    }

    public function increaseCopy($id)
    {
        $copy = ShortVideo::find($id);
        $copy->copy = $copy->copy + 1;
        $copy->save();
        dd($copy);
        return response()->json($copy);
    }
}
