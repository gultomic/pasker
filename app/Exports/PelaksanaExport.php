<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelaksanaExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStrictNullComparison
{
    protected $pelaksana;

    public function __construct($pelaksana)
    {
        $this->pelaksana = $pelaksana;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pelaksana',
            'Alamat Email',
            'Layanan',
            'Total Melayani',
            'Skor',
            'Indeks Kepuasan'
        ];
    }

    public function collection()
    {
        return $this->pelaksana
            ->map(function($q, $x){

                return [
                    'nomor' => $x + 1,
                    'nama' => $q['nama'],
                    'email' => $q['email'],
                    'jumlah_pelayanan' => $q['jumlah_pelayanan'],
                    'total_pelayanan' => $q['total_pelayanan'],
                    'skor_survei' => round($q['skor_survei']),
                    'indeks_kepuasan' => ($q['indeks_kepuasan'] != 0)
                        ? number_format($q['indeks_kepuasan'], 1) . '%'
                        : $q['indeks_kepuasan'],
                ];
            });
    }
}
