<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTrayeksTable extends Migration
{
    public function up()
    {
        Schema::create('trayeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_trayek');
            $table->string('lokasi_berangkat');
            $table->string('lokasi_tiba');
            $table->string('via')->nullable();
          
            $table->timestamps();
        });

        DB::table('trayeks')->insert([
            'id'=>1,
            'nama_trayek'=>'TRY-0001',
            'lokasi_berangkat'=>'bwi',
            'lokasi_tiba'=>'srono',
            'via'=>'bus',
        ]);
        
        DB::table('trayeks')->insert([
            'id'=>2,
            'nama_trayek'=>'TRY-0002',
            'lokasi_berangkat'=>'bwi',
            'lokasi_tiba'=>'srono',
            'via'=>'bus',         
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('trayeks');
    }
}
