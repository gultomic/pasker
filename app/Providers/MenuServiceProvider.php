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
                                'icon'=>'fas fa-th-large'
                            ],
                            [
                                'route'=>'admin.pelayanan',
                                'path'=>'admin.pelayanan*',
                                'title'=>'Pelayanan',
                                'icon'=>'fas fa-people-arrows'
                            ],
                            [
                                'route'=>'admin.pertanyaan',
                                'path'=>'admin.pertanyaan*',
                                'title'=>'Daftar Pertanyaan',
                                'icon'=>'fas fa-clipboard-list'
                            ],
                            [
                                'route'=>'admin.klien',
                                'path'=>'admin.klien*',
                                'title'=>'Data Pengunjung',
                                'icon'=>'fas fa-users'
                            ],
                            [
                                'route'=>'admin.akun',
                                'path'=>'admin.akun*',
                                'title'=>'Akun User',
                                'icon'=>'fas fa-user-friends'
                            ],
                            [
                                'route'=>'admin.pengaturan',
                                'path'=>'admin.pengaturan*',
                                'title'=>'Pengaturan',
                                'icon'=>'fas fa-tools'
                            ],
                        );
                        break;
                    default:
                        $router->push(
                            [
                                'route'=>'dashboard',
                                'path'=>'dashboard*',
                                'title'=>'Dashboard',
                                'icon'=>'fas fa-th-large'
                            ],
                            [
                                'route'=>'staf.pelayanan.history',
                                'path'=>'staf.pelayanan*',
                                'title'=>'History Pelayanan',
                                'icon'=>'fas fa-history'
                            ],
                            [
                                'route'=>'staf.profile',
                                'path'=>'staf.profile*',
                                'title'=>'Profil',
                                'icon'=>'fas fa-address-card'
                            ],
                        );
                        break;
                }

                $view->with('appRoutes', $router);
            }
        });
    }
}
