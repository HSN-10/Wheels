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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // post details
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->boolean('negotiable')->default(true);
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');;
            $table->integer('type_post')->default(1);

            // car details
            $table->string('maker');
            $table->string('model');
            $table->string('colour');
            $table->integer('years');
            $table->unsignedBigInteger('body_type_id');
            $table->foreign('body_type_id')->references('id')->on('body_types')->onDelete('CASCADE');
            $table->integer('transmission_type');
            $table->integer('kilometrage');
            $table->integer('gas_type');
            $table->integer('doors');
            $table->integer('engine_cylinders');
            $table->integer('condition');
            $table->integer('number_of_owners');
            $table->integer('number_of_accidents');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
