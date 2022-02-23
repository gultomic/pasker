<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PE;
use App\Models\Config;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PelaksanaExport;
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

            return $data;
    }

    public function adminStafExport ()
    {
        $time = Carbon::now()->format('Ymd-His');
        return Excel::download(new PelaksanaExport($this->adminStaf()), "leaderboard_pelaksana_$time.xlsx");
    }

    public function adminChart ()
    {
        $data = [
            'bar' => PE::all()
                ->groupBy('tanggal')
                ->mapWithKeys(function($q, $k) {
                    return [$k => $q->count()];
                }),
            'pie' => $this->adminPelayanan(),
        ];
        return $data;
    }

    public function stafPelayanan ()
    {
        return Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();
    }
}
