<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\Config;
use Auth;

class DashboardController extends Controller
{
    public function index ()
    {
        $level = Auth::user()->role->level;

        switch ($level) {
            case 'master':
                $view = 'admin.dashboard';
                $data = [
                    'pelayanan' => $this->adminPelayanan(),
                    'loket' => Config::where('title', 'loket_pelayanan')->first()->refs,
                ];
                break;
            case 'staf':
            default:
                $view = 'staf.dashboard';
                $data = [
                    'pelayanan' => $this->stafPelayanan()
                ];
                break;
        }

        return view($view, [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
            'collection' => $data
        ]);
    }

    public function adminPelayanan ()
    {
        $data = Pelayanan::all()->map(function ($q) {
            $k = $q->kuesioner->map(function ($q) {
                return $q->survei->average('skor');
            })->values();
            $p = ($k->sum() / 3) / $k->count() * 100;

            return [
                'id' => $q->id,
                'title' => $q->title,
                'pengunjung' => number_format($q->pengunjung->count(), 0, ',', '.'),
                'kepuasan' => round($p),
            ];
        })->all();

        return $data;
    }

    public function adminLoket ()
    {
        $data = Config::where('title', 'loket_pelayanan')->first()->refs;
    }

    public function stafPelayanan ()
    {
        return Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();
    }
}
