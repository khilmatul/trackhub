<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePendataansTable extends Migration
{
    public function up()
    {
        Schema::create('pendataans', function (Blueprint $table) {
            $table->id();
            $table->date('waktu_pendataan');
            $table->string('type_absen');
            $table->bigInteger('angkutan_id')->unsigned()->nullable();
            $table->foreign('angkutan_id')->references('id')->on('angkutans')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('penumpang_id')->unsigned()->nullable();
<<<<<<< HEAD
            $table->foreign('penumpang_id')->references('id')->on('penumpangs')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();

          
        });

        // DB::table('pendataans')->insert([
        //     'id'=>1,
        //     'waktu_pendataan'=>'2022-09-01',
        //     'angkutan_id'=>1,
        //     'penumpang_id'=>1,
        //     'type_absen'=>'Scan QR'

        // ]);

        // DB::table('pendataans')->insert([
        //     'id'=>2,
        //     'waktu_pendataan'=>'2022-12-21',
        //     'angkutan_id'=>2,
        //     'penumpang_id'=>2,
        //     'type_absen'=>'Absen Penumpang'

        // ]);
=======
            $table->foreign('penumpang_id')->references('id')->on('penumpangs')->onDelete('cascade')->onUpdate('cascade');           
            $table->timestamps();        
        });

        DB::table('pendataans')->insert([
            'id'=>1,
            'waktu_pendataan'=>'2022-09-01',
            'angkutan_id'=>1,
            'penumpang_id'=>1,
            'type_absen'=>'Scan QR'
        ]);

        DB::table('pendataans')->insert([
            'id'=>2,
            'waktu_pendataan'=>'2022-12-21',
            'angkutan_id'=>2,
            'penumpang_id'=>2,
            'type_absen'=>'Absen Penumpang'
        ]);
>>>>>>> 19cad015b11d01aa4fd799b0d90ee59c0f67063a
    }
    
    public function down()
    {
        Schema::dropIfExists('pendataans');
    }
}
