<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class RiwayatPelayanan implements Fromcollection, WithHeadings, WithStrictNullComparison
{
    public $rows, $title;

     public function __construct($payload, $title)
    {
        $this->rows = $payload;
        $this->title = $title;
    }

    public function collection()
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            [ $this->title ],
            [ 'Tanggal', 'Total Melayani', 'Skor' ]
        ];
    }
}
