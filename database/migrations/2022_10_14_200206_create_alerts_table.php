<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();

            // alert details
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('price_from');
            $table->integer('price_to');

            // car details
            $table->string('maker')->nullable();
            $table->string('model')->nullable();
            $table->string('colour')->nullable();
            $table->integer('years')->nullable();
            $table->unsignedBigInteger('body_type_id')->nullable();
            $table->foreign('body_type_id')->references('id')->on('body_types');
            $table->string('transmission_type')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->string('gas_type')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('enginec_cylinders')->nullable();
            $table->string('condition')->nullable();

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
        Schema::dropIfExists('alerts');
    }
};
