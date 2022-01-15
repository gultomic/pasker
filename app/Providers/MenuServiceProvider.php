<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            if (Auth::check()) {
                $level = Auth::user()->role->level;
                $router = collect();

                switch ($level) {
                    case 'master':
                        $router->push(
                            [
                                'route'=>'dashboard',
                                'path'=>'dashboard',
                                'title'=>'Dashboard',
                                'icon'=>'fa-th-large'
                            ],
                            [
                                'route'=>'pelayanan',
                                'path'=>'pelayanan',
                                'title'=>'Pelayanan',
                                'icon'=>'fa-people-arrows'
                            ],
                            [
                                'route'=>'pertanyaan',
                                'path'=>'pertanyaan',
                                'title'=>'Daftar Pertanyaan',
                                'icon'=>'fa-clipboard-list'
                            ],
                            [
                                'route'=>'klien',
                                'path'=>'klien',
                                'title'=>'Data Pengunjung',
                                'icon'=>'fa-users'
                            ],
                            [
                                'route'=>'akun',
                                'path'=>'akun',
                                'title'=>'Akun User',
                                'icon'=>'fa-user-friends'
                            ],
                            [
                                'route'=>'pengaturan',
                                'path'=>'pengaturan',
                                'title'=>'Pengaturan',
                                'icon'=>'fa-tools'
                            ],
                        );
                        break;
                    default:
                        $router->push(
                            [
                                'route'=>'dashboard',
                                'path'=>'dashboard',
                                'title'=>'Dashboard',
                                'icon'=>'fa-th-large'
                            ],
                        );
                        break;
                }

                $view->with('appRoutes', $router);
            }
        });
    }
}
