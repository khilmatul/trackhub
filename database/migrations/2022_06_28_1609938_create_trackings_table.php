<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('waktu_tracking');
            $table->string('latitude_tracking_awal')->nullable();
            $table->string('longitude_tracking_awal')->nullable();
            $table->string('latitude_tracking_akhir')->nullable();
            $table->string('longitude_tracking_akhir')->nullable();
            
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('angkutan_id')->unsigned()->nullable();
            $table->timestamps();
        });
        //insert table trackings
        $trackings = [
            [
                'waktu_tracking' => '2020-06-28 16:09:38',
                'latitude_tracking_awal' => '-8.4843571',
                'longitude_tracking_awal' => '114.4284568',
                'latitude_tracking_akhir' => '-8.4843949',
                'longitude_tracking_akhir' => '114.3280451',
                'user_id' => '2',
                'angkutan_id' => '1',
                'id' => '1',
            ],
          
            [
                'waktu_tracking' => '2020-06-28 16:09:38',
                'latitude_tracking_awal' => '-8.515535697735183',
                'longitude_tracking_awal' => '114.26835401317283',
                'latitude_tracking_akhir' => '-8.466749441437647',
                'longitude_tracking_akhir' => '114.2261563523515',
                'user_id' => '3',
                'angkutan_id' => '2',
                'id' => '3',
            ],
           
        ];
        DB::table('trackings')->insert($trackings);
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
