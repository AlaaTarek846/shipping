<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->boolean('is_active')->default(1);
            $table->enum('user_type', ['admin','client','representative','employee','company','speradmin'])->default('client');
            $table->text('token')->nullable();
            $table->integer('firebase_id')->nullable();
            $table->date('package_date')->nullable();
            $table->date('free_date')->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
