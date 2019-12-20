<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("total")->nullable();
            $table->integer("client_user_id");
            $table->integer("client_id");
            $table->integer("plan_id")->nullable();
            $table->integer("months_number")->nullable();
            $table->integer("years_number")->nullable();
            $table->integer("template_id")->nullable();
            $table->integer("website_id")->nullable();
            $table->integer("plugin_id")->nullable();
            $table->string("payment_method");
            $table->integer("bank_id")->nullable();
            $table->string("transferer_name")->nullable();
            $table->string("transferer_bank")->nullable();
            $table->string("transferer_account_number")->nullable();
            $table->string("transferer_date")->nullable();
            $table->string("transferer_image")->nullable();
            $table->timestamp("payment_date")->nullable();
            $table->string("status")->default("pending");
            $table->integer("promocode_id")->nullable();
            $table->tinyInteger('tamdid')->nullable()->default(0);
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
        Schema::dropIfExists('payments');
    }
}
