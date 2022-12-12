<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class HotPostComposer
{
    protected $postHot;

    public function __construct()
    {
        $this->postHot = Post::where('status', 2)->orderBy('created_date', 'desc')->where("hot", 1)->first();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('postHot', $this->postHot);
    }
}
