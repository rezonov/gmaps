<?php

namespace App\Providers;

use App\Daughters;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('Дочерние сайты'));

            $items = Daughters::all()->map(function (Daughters $page) {
                return [
                    'text' => $page['name'],
                    'url' => '/daughters/control/'.$page['id'],
                    'icon' => 'telegram text-blue'
                ];
            });
            $event->menu->add(...$items);


        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
