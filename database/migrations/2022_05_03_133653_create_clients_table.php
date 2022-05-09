<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('secondname');
            $table->string('firstname');
            $table->string('patronymic');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('city_id')->nullable();
            $table->string('address');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
