<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostbycateComposer
{
    protected $hotcate;

    public function __construct()
    {
        $this->hotcate = Category::where("parent_id", null)->where('position', 2)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('hotcate', $this->hotcate);
    }
}
