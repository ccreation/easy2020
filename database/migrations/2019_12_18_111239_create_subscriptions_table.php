<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("payment_id");
            $table->string("total")->nullable();
            $table->integer("client_user_id");
            $table->integer("client_id");
            $table->integer("plan_id")->nullable();
            $table->integer("months_number")->nullable();
            $table->integer("years_number")->nullable();
            $table->timestamp("subscription_date")->nullable();
            $table->string("status")->default("pending");
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
        Schema::dropIfExists('subscriptions');
    }
}
