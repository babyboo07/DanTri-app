<?php

namespace App\Providers;

use App\View\Composers\AllCategoryComposer;
use App\View\Composers\CategoryComposer;
use App\View\Composers\HotPostComposer;
use App\View\Composers\MediaVideoComposer;
use App\View\Composers\NewPostComposer;
use App\View\Composers\NewsCateComposer;
use App\View\Composers\PostbycatebotomComposer;
use App\View\Composers\PostbycatebottomComposer;
use App\View\Composers\PostbycateComposer;
use App\View\Composers\PostDetailComposer;
use App\View\Composers\ShortVideoComposer;
use App\View\Composers\SpecialPostComposer;
use App\View\Composers\SpotlightHotComposer;
use App\View\Composers\SpotlightPostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Category Client
        View::composer('client.category.client-category', CategoryComposer::class);
        View::composer('client.category.client-allCategory', AllCategoryComposer::class);

        // Post client
        View::composer('client.news.client-postHot', HotPostComposer::class);
        View::composer('client.news.client-newPost', NewPostComposer::class);
        View::composer('client.news.client-postSpecial', SpecialPostComposer::class);
        View::composer('client.news.client-postSpotlight', SpotlightPostComposer::class);
        View::composer('client.news.client-spotlightHot', SpotlightHotComposer::class);

        // Video client
        View::composer('client.video.client-mediavideo', MediaVideoComposer::class);
        View::composer('client.video.client-shortvideo', ShortVideoComposer::class);

        View::composer('client.common.postbycatecenter', PostbycateComposer::class);
        View::composer('client.common.postbycatebottom', PostbycatebottomComposer::class);
    }
}
