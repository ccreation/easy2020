<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("client_id");
            $table->integer("user_id")->default(0);
            $table->integer("category_id")->default(0);
            $table->integer("templatee_id")->nullable();
            $table->string("slug")->nullable();
            $table->string("domain")->nullable();
            $table->string("price")->nullable();
            $table->boolean("multi_lang")->default(true);
            $table->string("default_lang")->default("ar");
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->text("description_ar")->nullable();
            $table->text("description_en")->nullable();
            $table->string("color1")->default("#763a96")->nullable();
            $table->string("color2")->default("#551B74")->nullable();
            $table->string("font")->default("Droid Arabic Kufi")->nullable();
            $table->string("logo")->nullable();
            $table->text("socials_ar")->nullable();
            $table->text("socials_en")->nullable();
            $table->integer("homepage")->nullable();
            $table->integer("topbar_type")->default(1);
            $table->tinyInteger('topbar_show')->default(1);
            $table->integer("footer_type")->nullable();
            $table->tinyInteger('footer_show')->default(1);
            $table->string('login_bg_image')->default("https://i.ibb.co/JpNphL6/s-2x.png");
            $table->string('login_bg_color')->default("rgba(118, 58, 150, 0.65)");
            $table->tinyInteger("login_page_button")->default(0);
            $table->string("login_page_button_icon")->default("fa fa-user");
            $table->integer("login_page_button_type")->default(4);
            $table->string("login_page_button_color")->default("")->nullable();
            $table->string("login_page_button_text_ar")->default("تسجيل الدخول");
            $table->string("login_page_button_text_en")->default("sign in");
            $table->string("login_page_button_text_color")->default("#FFFFFF")->nullable();
            $table->integer("login_page_button_text_font_size")->default(16);
            $table->string("login_page_button_text_font_weight")->default("normal");
            $table->string("login_page_button_text_font_family")->default("")->nullable();
            $table->tinyInteger("default_color_n_font")->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('block_reason')->nullable();
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
        Schema::dropIfExists('websites');
    }
}
