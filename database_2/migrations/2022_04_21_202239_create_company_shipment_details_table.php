<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyShipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_shipment_details', function (Blueprint $table) {
            $table->id();
            $table->double('shipment_price',8,2)->default(0);
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->bigInteger('company_account_id')->unsigned()->nullable();
            $table->foreign('company_account_id')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->bigInteger('shipment_status_id')->unsigned()->nullable();
            $table->foreign('shipment_status_id')->references('id')->on('shipment_status')->onDelete('cascade');
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
        Schema::dropIfExists('company_shipment_details');
    }
}
