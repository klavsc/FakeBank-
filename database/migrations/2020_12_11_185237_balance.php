<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Balance extends Migration
{

    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->id();
            $table->string('receiver');
            $table->string('bank_account');
            $table->integer('value');
            $table->timestamps();
        });
    }


    public function down()
    {
        //
    }
}
