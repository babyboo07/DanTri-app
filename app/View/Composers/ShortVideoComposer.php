<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShortVideoComposer
{
    protected $shortVid;

    public function __construct()
    {
        $this->shortVid = DB::table('short_videos')
            ->leftJoin('categories', 'categories.id', 'short_videos.cate_id')
            ->where('short_videos.status', 2)
            ->where('short_videos.kind', 2)
            ->orderBy('short_videos.created_at', 'desc')
            ->select('short_videos.*', 'categories.cateName')
            ->take(5)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('shortVid', $this->shortVid);
    }
}
