<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostbycatebottomComposer
{
    protected $catebottom;

    public function __construct()
    {
        $this->catebottom = Category::where("parent_id", null)->where('position', 3)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('catebottom', $this->catebottom);
    }
}
