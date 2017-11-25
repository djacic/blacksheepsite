<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryBrand extends Migration
{

    public function up()
    {
        Schema::create('category_brand', function (Blueprint $table) {
            $table->unsignedInteger("category_id");
            $table->unsignedInteger("brand_id");
            $table->timestamps();
            $table->primary(["category_id", "brand_id"]);

            //Foreign keys
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
