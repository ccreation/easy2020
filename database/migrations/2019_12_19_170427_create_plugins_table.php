<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name_ar");
            $table->string("name_en")->nullable();
            $table->string("price")->default("0");
            $table->string("image")->nullable();
            $table->timestamps();
        });

        Schema::create('client_plugin', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('plugin_id');
            $table->integer("payment_id")->nullable();
            $table->foreign("client_id")->references("id")->on("clients")->onDelete("cascade");
            $table->foreign("plugin_id")->references("id")->on("plugins")->onDelete("cascade");
            $table->string("price");
            $table->string("status")->default("pending");
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
        Schema::dropIfExists('plugins');
        Schema::dropIfExists('client_plugin');
    }
}
