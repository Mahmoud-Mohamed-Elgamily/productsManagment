<?php

namespace App\Providers;
use App\Models\Criteria;

use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer(['products.fields'], function ($view) {
            $criteriaItems = Criteria::pluck('name','id')->toArray();
            $view->with('criteriaItems', $criteriaItems);
        });
        View::composer(['products.fields'], function ($view) {
            $criteriaItems = Criteria::pluck('name','id')->toArray();
            $view->with('criteriaItems', $criteriaItems);
        });
        //
    }
}