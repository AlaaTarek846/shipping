<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative_expenses', function (Blueprint $table) {
            $table->id();
            $table->double('amount',8,2)->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('treasurie_id')->unsigned()->nullable();
            $table->foreign('treasurie_id')->references('id')->on('treasuries')->onDelete('cascade');
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
        Schema::dropIfExists('representative_expenses');
    }
}
