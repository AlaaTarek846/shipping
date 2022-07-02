<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_start_id')->unsigned();
            $table->foreign('store_start_id')->references('id')->on('stores')->onDelete('cascade');
            $table->bigInteger('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->bigInteger('representative_id')->unsigned()->nullable();
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade');
            $table->bigInteger('store_end_id')->unsigned()->nullable();
            $table->foreign('store_end_id')->references('id')->on('stores')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('shipment_transfers');
    }
}
