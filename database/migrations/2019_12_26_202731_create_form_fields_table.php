<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0);
            $table->integer("client_id");
            $table->integer("form_id");
            $table->string("name");
            $table->string("placeholder")->nullable();
            $table->string("type");
            $table->string("required")->default("0");
            $table->text("options")->nullable();
            $table->integer('space')->default(1);
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
        Schema::dropIfExists('form_fields');
    }
}
