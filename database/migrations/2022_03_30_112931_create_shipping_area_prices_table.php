<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAreaPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_area_prices', function (Blueprint $table) {
            $table->id();
            $table->double('transportation_price',8,2)->default(0);
            $table->integer('delivery_time')->nullable();
            $table->integer('returned_time')->nullable();
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
        Schema::dropIfExists('shipping_area_prices');
    }
}
