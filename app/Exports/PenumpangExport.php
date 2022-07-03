<?php

namespace App\Exports;

use App\Models\Penumpang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;

class PenumpangExport implements WithEvents
{
    // var $id=0;
    // public function __construct($id)
    // {
    //     $this->id = $id;
    // }
    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('penumpang.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable());
                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet)
    {
    
      
        

        $data = Penumpang::all();

           
  
        $i=6;
        foreach($data as $row){
            $sheet->setCellValue('D'.$i, $row->nama);
            $sheet->setCellValue('E'.$i, $row->alamat);
            $sheet->setCellValue('F'.$i, $row->no_telp);
            $sheet->setCellValue('G'.$i, $row->tgl_lahir);
            $sheet->setCellValue('H'.$i, $row->asal_sekolah);
            $sheet->setCellValue('I'.$i, $row->qrcode);
            $sheet->setCellValue('J' .$i, $row->tgl_input_penumpang);


      
            $i++;
        }
  

      
     
    }
    
    //create sheet table penumpangs in excel array



    // public function collection()
    // {
    //     return Penumpang::all();
    // }


}
