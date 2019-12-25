<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodeClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('promocode_client');
        Schema::create('promocode_client', function (Blueprint $table) {
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('promocode_id');
            $table->integer("plan_id")->nullable();
            $table->integer("template_id")->nullable();
            $table->timestamp('used_at');

            $table->primary(['client_id', 'promocode_id']);

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('promocode_id')->references('id')->on(config('promocodes.table', 'promocodes'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocode_client');
    }
}
