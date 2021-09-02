<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCraftStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('craft_store', function (Blueprint $table) {
            $table->unsignedBigInteger('craft_id');
            $table->unsignedBigInteger('store_id');
            $table->primary(['craft_id','store_id']);
            
            //外部キー制約
            $table->foreign('craft_id')->references('id')->on('crafts')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('craft_store');
    }
    
    
}
