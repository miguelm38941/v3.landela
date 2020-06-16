<?php

namespace App\Exports;

use App\Models\StandardBL;
use App\Models\SupplierExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SummaryExport implements FromView, WithEvents
{
    private $billingData;

    public function __construct($billingData) 
    {
        $this->billingData = $billingData;
    }

    public function view(): View
    {
        return view('billingprocess.summary_layout', ['billing_data' => $this->billingData]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // All headers - set font size to 14
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                // Apply array of styles to B2:G8 cell range
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ]
                    ]
                ];
                /*$event->sheet->getDelegate()->getStyle('A15:F15')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A16:F16')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A17:F17')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A18:F18')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A19:F19')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A20:F20')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A21:F21')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A22:F22')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A23:F23')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A24:F24')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B25:F25')->applyFromArray($styleArray);

                $event->sheet->getDelegate()->getStyle('G15:H15')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('G16:H16')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('G17:H17')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('I17:J17')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('K17:L17')->applyFromArray($styleArray);*/

                // Set first row to height 20
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

                // Set A1:D4 range to wrap text in cells
                //$event->sheet->getDelegate()->getStyle('A1:D4')
                //    ->getAlignment()->setWrapText(true);
            },
        ];
    }

}
