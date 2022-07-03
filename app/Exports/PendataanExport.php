<?php

namespace App\Exports;

use App\Models\Pendataan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PendataanExport implements  FromView, ShouldAutoSize,  WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    var $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
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
        $pendataan = $this->id;
        //create join table pendataans penumpang supir user
        // $pendataan = DB::table('pendataans')->leftJoin('penumpangs','pendataans.penumpang_id','penumpangs.id')
        // ->leftjoin('angkutans','pendataans.angkutan_id','angkutans.id')->get();

        
        return view('dashboard.rekapitulasi.excel', compact('pendataan'));
    }
}
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Pendataan::all();
//     }
// }
