<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->string("monthly_subscription")->default("0");
            $table->string("annual_subscription")->default("0");
            $table->string("discount_percentage")->default("0");
            $table->string("discount_amount")->default("0");
            $table->string("minimum_subscription_period")->default(1);
            $table->string("color")->default("#eeeeee");
            $table->string("website_numbers")->default("1");
            $table->integer("disk_space")->default(10);
            $table->tinyInteger("root_domain")->default(0);
            $table->tinyInteger("multiple_users")->default(0);
            $table->text("templates")->nullable();
            $table->tinyInteger("default_lang")->default(0);
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
        Schema::dropIfExists('plans');
    }
}
