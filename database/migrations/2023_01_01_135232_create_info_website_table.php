<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_website', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->unsignedInteger('city');
            $table->unsignedInteger('district');
            $table->unsignedInteger('ward');
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
        Schema::dropIfExists('info_website');
    }
}
