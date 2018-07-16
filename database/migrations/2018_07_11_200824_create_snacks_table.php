<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snacks', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('vending_machine_id')->default(1);
            $table->string('name')->unigue();
            $table->string('code')->unigue();
            $table->double('price',4,2);
            $table->integer('quantity')->default(0);
            $table->boolean('is_available')->default(0);
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
        Schema::dropIfExists('snacks');
    }
}
