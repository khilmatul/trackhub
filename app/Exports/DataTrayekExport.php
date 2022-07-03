<?php

namespace App\Exports;

use App\Models\Trayek;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class DataTrayekExport  implements FromView, ShouldAutoSize,  WithEvents
{
   
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'B3:W3'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                
            },
        ];
    }
    public function view(): View
    {
        $trayek = Trayek::all();
       
        return view('dashboard.trayek.excel', compact('trayek'));
    }

}
