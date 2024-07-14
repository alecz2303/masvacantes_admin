<?php

namespace App\Providers;

use App\Actions\MyAction;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Events\Dispatcher;
use TCG\Voyager\Actions\ViewAction;
use TCG\Voyager\Actions\DeleteAction;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Database\Schema\Index;
use TCG\Voyager\Database\Schema\Table;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Database\Schema\Column;
use TCG\Voyager\Database\Schema\SchemaManager;

class AppServiceProvider extends ServiceProvider
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
        Schema::defaultStringLength(191);
        //Voyager::useModel('User', \App\Models\User::class);
        Voyager::addAction(\App\Actions\VerEmpleo::class);
        Voyager::replaceAction(ViewAction::class, MyAction::class);
    }
}
