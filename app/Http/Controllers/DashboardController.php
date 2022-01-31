<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Pelayanan;
use App\Models\Config;
use App\Models\User;
use Carbon\Carbon;
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
                    'loket' => $this->adminLoket(),
                    'staf' => $this->adminStaf(),
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
                'pengunjung' => number_format($q->pengunjung->count(), 0, ',', '.'),
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
                $skor = $q->historyPelayanan->map(function ($q) {
                    return $q->survei->average('skor');
                })->sum();

                $total = $q->historyPelayanan->count();
                $jumlah = $q->historyPelayanan->groupBy('pelayanan_id')->count();

                return [
                    'nama' => $q->profile->refs['fullname'],
                    'email' => $q->email,
                    'photo' => $q->profile->refs['photo'],
                    'total_pelayanan' => $total,
                    'jumlah_pelayanan' => $jumlah,
                    'skor_survei' => $skor / 3,
                    'indeks_kepuasan' => ($skor / 3) / $total * 100,
                ];
            });

            // dd($data);
            return $data;
    }

    public function stafPelayanan ()
    {
        return Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();
    }
}
