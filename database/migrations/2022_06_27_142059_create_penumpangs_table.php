<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePenumpangsTable extends Migration
{
    public function up()
    {
        Schema::create('penumpangs', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_input_penumpang');
            $table->string('nama');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('no_telp');
            $table->string('asal_sekolah')->nullable();
            $table->string('qrcode')->nullable();
            $table->timestamps();
        });
        DB::table('penumpangs')->insert([
            'id'=>1,
            'tgl_input_penumpang'=>'2022-09-27',
            'nama'=>'joko',
            'alamat'=>'gambiran',
            'tgl_lahir'=>'2022-09-27',
            'no_telp'=>'2322',
            'asal_sekolah'=>'SMK',
            'qrcode'=>'12ab'

        ]);
        DB::table('penumpangs')->insert([
            'id'=>2,
            'tgl_input_penumpang'=>'2022-06-27',
            'nama'=>'janda',
            'alamat'=>'mangir',
            'tgl_lahir'=>'2022-06-27',
            'no_telp'=>'333',
            'qrcode'=>'12abx',
            'asal_sekolah'=>'SMK'

        ]);
    
    }

    public function down()
    {
        Schema::dropIfExists('penumpangs');
    }
}
