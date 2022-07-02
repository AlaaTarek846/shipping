<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportShipmenttsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_shipmentts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('order_number')->nullable();
            $table->string('client_name');
            $table->integer('client_code')->nullable();
            $table->string('area');
            $table->text('address');
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->text('name_product');
            $table->text('description_product')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->integer('count')->nullable();
            $table->double('price',8,2)->default(0);
            $table->double('shipping_price',8,2)->default(0);
            $table->string('service_types');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('import_shipmentts');
    }
}
