<?php

namespace App\Exports;

use App\Models\Angkutan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

class DataAngkutanExport implements FromView, ShouldAutoSize,  WithEvents
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
      $angkutan = DB::table('angkutans')->leftJoin('trayeks','angkutans.trayek_id','trayeks.id')
      ->leftJoin('users','angkutans.user_id','users.id')->get();
       
        return view('dashboard.angkutan.excel', compact('angkutan'));
    }
}
