<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('name_shipment');
            $table->text('description')->nullable();
            $table->integer('customer_code')->nullable();
            $table->double('product_price',8,2)->default(0)->nullable();
            $table->integer('order_number')->nullable();
            $table->integer('count')->nullable();
            $table->double('shipping_price',8,2)->default(0)->nullable();
            $table->double('return_price',8,2)->default(0);
            $table->integer('weight')->nullable();
            $table->string('size')->nullable();
            $table->text('notes')->nullable();
            $table->date('delivery_date')->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->bigInteger('service_type_id')->unsigned()->nullable();
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->bigInteger('shipment_status_id')->unsigned()->nullable();
            $table->foreign('shipment_status_id')->references('id')->on('shipment_status')->onDelete('cascade');
            $table->bigInteger('representative_id')->unsigned()->nullable();
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade');
            $table->bigInteger('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('additional_service_id')->unsigned()->nullable();
            $table->foreign('additional_service_id')->references('id')->on('additional_services')->onDelete('cascade');
            $table->bigInteger('reason_id')->unsigned()->nullable();
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->boolean('end')->default(0);
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
        Schema::dropIfExists('shipments');
    }
}
