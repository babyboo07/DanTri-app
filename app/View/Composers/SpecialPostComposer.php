<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SpecialPostComposer
{
    protected $postSpecials;

    public function __construct()
    {
        $this->postSpecials = DB::table('posts')
            ->where('status', 2)
            ->where('hot', null)
            ->orderBy('created_date', 'desc')
            ->skip(2)
            ->take(3)
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
        $view->with('postSpecials', $this->postSpecials);
    }
}
