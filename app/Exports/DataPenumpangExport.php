<?php

namespace App\Exports;

use App\Models\Penumpang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

class DataPenumpangExport implements  FromView, ShouldAutoSize,  WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        //create join table pendataans penumpang supir user
        $penumpang = Penumpang::all();

        
        return view('dashboard.penumpang.excel', compact('penumpang'));
    }
}
