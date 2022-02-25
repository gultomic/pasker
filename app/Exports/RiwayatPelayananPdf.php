<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
// use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RiwayatPelayananPdf
implements
    FromCollection, ShouldAutoSize,
    WithHeadings, WithStrictNullComparison,
    WithTitle, WithEvents
{
    use Exportable;

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
        return ['Tanggal', 'Total Melayani', 'Skor' ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function registerEvents():array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:C1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(22);
                $event->sheet->getDelegate()->getStyle("A1:C1")
                    ->applyFromArray([
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]);

                $rows = count($this->rows) + 2;
                for ($i=1; $i <= count($this->rows); $i++) {
                    $r = $i+1;
                    $delegate = $event->sheet->getDelegate();
                    $delegate->getRowDimension($r)->setRowHeight(16);
                    $delegate->getStyle("A$r:C$r")->applyFromArray([
                        'alignment' => [
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ]);
                    $delegate->getStyle("A$r")->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
                        ->setIndent(1);
                    $delegate->getStyle("B$r:C$r")->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT)
                        ->setIndent(1);
                }
            }
        ];
    }
}
