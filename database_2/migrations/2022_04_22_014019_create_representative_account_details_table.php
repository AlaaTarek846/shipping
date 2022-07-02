<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative_account_details', function (Blueprint $table) {
            $table->id();
            $table->double('collection_balance',8,2)->default(0);
            $table->double('commission',8,2)->default(0);
            $table->bigInteger('representative_id')->unsigned();
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade');
            $table->bigInteger('representative_account_id')->unsigned()->nullable();
            $table->foreign('representative_account_id')->references('id')->on('representative_accounts')->onDelete('cascade');
            $table->bigInteger('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->bigInteger('shipment_status_id')->unsigned();
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
        Schema::dropIfExists('representative_account_details');
    }
}
