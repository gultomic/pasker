<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PE;
use App\Models\Config;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;

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
                    'loket' => $this->adminLoket(),
                    'staf' => $this->adminStaf(),
                    'status' => Pelayanan::latest()->where('refs->aktif', '=', true)->get(),
                    'chart' => $this->adminChart(),
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
                'status' => $q->refs['aktif'],
                'pengunjung' => $q->pengunjung->count(),
                'kepuasan' => round($p),
            ];
        })->all();

        return $data;
    }

    public function adminLoket ()
    {
        $data = Config::where('title', 'loket_pelayanan')->first()->refs;
        $aktifLoket = Config::where('title', 'loket_aktif')->first()->refs;
        $result = new Collection();

        foreach ($data as $loket) {
            $aktif = $aktifLoket
                ->where('nama', $loket)
                ->where('tanggal', Carbon::now()->format('Y-m-d'))
                ->first();

            ($aktif == null)
                ? $result->push([
                    'nama' => $loket,
                    'tangal' => '',
                    'pelaksana' => '',
                    'pelayanan' => ''
                ])
                : $result->push($aktif);
        }

        return $result;
    }

    public function adminStaf ()
    {
        $data = User::with('historyPelayanan')
            ->whereHas('role', function ($q) {
                $q->where('level', 'staf');
            })
            ->get()
            ->map(function ($q) {
                $jumlah = $q->historyPelayanan->groupBy('pelayanan_id')->count();
                $total = $q->historyPelayanan->count();

                if ($total == 0) {
                    $skor = 0;
                    $indeks = 0;
                } else {
                    $skor = $q->historyPelayanan->map(function ($q) {
                        return $q->survei->average('skor');
                    })->sum();
                    $indeks = ($skor / 3) / $total * 100;
                }


                return [
                    'nama' => $q->profile->refs['fullname'],
                    'email' => $q->email,
                    'photo' => $q->profile->refs['photo'],
                    'total_pelayanan' => $total,
                    'jumlah_pelayanan' => $jumlah,
                    'skor_survei' => $skor,
                    'indeks_kepuasan' => $indeks,
                ];
            });
            // dd($data);
            return $data;
    }

    public function adminChart ()
    {
        $data = [
            'bar' => PE::all()
                ->groupBy('tanggal')
                // ->groupBy(function($d) {
                //     return Carbon::parse($d->tanggal)->format('Y-m');
                // })
                ->mapWithKeys(function($q, $k) {
                    return [$k => $q->count()];
                }),
            'pie' => $this->adminPelayanan(),
        ];
        // dd($pie);
        return $data;
    }

    public function stafPelayanan ()
    {
        return Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();
    }
}
