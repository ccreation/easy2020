<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete("cascade");
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('websites')->onDelete("cascade");
            $table->integer('website_id')->nullable()->unsigned();
            $table->integer("plan_id")->nullable();
            $table->integer("payment_id")->nullable();
            $table->string("price")->nullable();
            $table->tinyInteger("status")->default(1);
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
        Schema::dropIfExists('client_template');
    }
}
