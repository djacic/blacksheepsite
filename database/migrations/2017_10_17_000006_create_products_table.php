<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //Fields
            $table->increments('id');
            $table->timestamps();
            $table->string("name", 150);
            $table->mediumText("description");
            $table->boolean("is_active")->default(false);
            $table->boolean("is_offer")->default(false);
            $table->boolean("special")->default(false);
            $table->unsignedInteger("brand_id")->unsigned();
            $table->unsignedInteger("picture_id")->unsigned();
            $table->unsignedInteger("type_id")->unsigned()->nullable()->default(null);

            //Foreign keys
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('picture_id')->references('id')->on('pictures');
            $table->foreign('type_id')->references('id')->on('types');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
