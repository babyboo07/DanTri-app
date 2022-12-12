<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SpotlightPostComposer
{
    protected $spotlight;

    public function __construct()
    {
        $this->spotlight = DB::table('posts')
            ->where('status', 2)
            ->orderBy('created_date', 'desc')
            ->skip(6)
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
        $view->with('spotlight', $this->spotlight);
    }
}
