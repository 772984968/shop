<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name')->comment('商品分类ID');
            $table->integer('parent_id')->default(0)->comment('父级ID');
            $table->integer('level')->default(0)->comment('等级');
            $table->integer('sort')->default(0)->comment('分类排序');
            $table->timestamps();
            $table->comment='商品分类表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
