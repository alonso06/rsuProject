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
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('birth_date');
            $table->date('planting_date');
            $table->text('description')->nullable(true);
            $table->double('latitude');
            $table->double('longitude');
            $table->unsignedBigInteger('specie_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('user_id');   
            $table->foreign('specie_id')->references('id')->on('species');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('user_id')->references('id')->on('users');         
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
        Schema::dropIfExists('trees');
    }
};
