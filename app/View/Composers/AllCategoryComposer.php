<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class AllCategoryComposer
{
    protected $allCate;

    public function __construct()
    {
        $this->allCate = Category::where("parent_id", null)
            ->where("status", 1)->skip(2)->take(18)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allCate', $this->allCate);
    }
}
