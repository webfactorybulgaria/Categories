<?php

namespace TypiCMS\Modules\Categories\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Categories\Shells\Models\Category;
use TypiCMS\Modules\Categories\Shells\Models\CategoryTranslation;
use TypiCMS\Modules\Categories\Shells\Repositories\CacheDecorator;
use TypiCMS\Modules\Categories\Shells\Repositories\EloquentCategory;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Core\Shells\Observers\SlugObserver;
use TypiCMS\Modules\Core\Shells\Services\Cache\LaravelCache;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.categories'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['categories' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'categories');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'categories');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/categories'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Categories',
            'TypiCMS\Modules\Categories\Shells\Facades\Facade'
        );

        // Observers
        CategoryTranslation::observe(new SlugObserver());
        Category::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Categories\Shells\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Categories\Shells\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Categories\Shells\Repositories\CategoryInterface', function (Application $app) {
            $repository = new EloquentCategory(new Category());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'categories', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
