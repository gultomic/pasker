<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelayanan;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $level = Auth::user()->role->level;

        switch ($level) {
            case 'master':
                $view = 'admin.dashboard';
                $data = '';
                break;
            case 'staf':
            default:
                $view = 'staf.dashboard';
                $data = [
                    'pelayanan' => $this->pelayanan()
                ];
                break;
        }

        // dd($data);
        return view($view, [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
            'collection' => $data
        ]);
    }

    public function pelayanan()
    {
        return Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();
    }
}
