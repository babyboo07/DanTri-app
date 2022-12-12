<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NewPostComposer
{
    protected $newPosts;

    public function __construct()
    {
        $this->newPosts = DB::table('posts')
            ->where('status', 2)
            ->where('hot', null)
            ->orderBy('created_date', 'desc')
            ->take(2)
            ->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('newPosts', $this->newPosts);
    }
}
