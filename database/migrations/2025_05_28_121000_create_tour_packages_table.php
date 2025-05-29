<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title');
            $table->string('location');
            $table->string('duration');
            $table->string('max_people');
            $table->decimal('price', 8, 2);
            $table->decimal('rating', 2, 1);
            $table->text('description');
            $table->string('image_path');
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::dropIfExists('tour_packages');
    }
};
