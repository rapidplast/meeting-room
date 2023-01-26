<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->string('reservation_code');
            $table->index('reservation_code');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id')->references('meeting_id')->on('meeting')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->time('reservation_time');
            $table->time('reservation_time_out');
            $table->string('ket');            
            $table->unsignedBigInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
