<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MediaVideoComposer
{
    protected $mediaVid;

    public function __construct()
    {
        $this->mediaVid = DB::table('short_videos')
            ->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->where('kind', 1)
            ->where("hot", 1)->take(3)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mediaVid', $this->mediaVid);
    }
}
