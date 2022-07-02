<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferringTreasuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferring_treasuries', function (Blueprint $table) {
            $table->id();
            $table->double('price',8,2)->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('treasurie_start_id')->unsigned()->nullable();
            $table->foreign('treasurie_start_id')->references('id')->on('treasuries')->onDelete('cascade');
            $table->bigInteger('treasurie_end_id')->unsigned()->nullable();
            $table->foreign('treasurie_end_id')->references('id')->on('treasuries')->onDelete('cascade');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('transferring_treasuries');
    }
}
