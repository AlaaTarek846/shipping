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
            $table->double('returned_price',8,2)->default(0);
            $table->double('replacement_price',8,2)->default(0)->nullable();
            $table->double('weight_price',8,2)->default(0)->nullable();
            $table->integer('delivery_time')->nullable();
            $table->integer('returned_time')->nullable();
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
