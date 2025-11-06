<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('hunting', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('tour_name');
            $table->string('hunter_name');
            $table->unsignedInteger('guide_id'); 
            $table->date('date');
            $table->unsignedSmallInteger('participants_count')->default(1);
            $table->timestamps();

            $table->foreign('guide_id')
                  ->references('id')
                  ->on('guides')
                  ->onDelete('cascade'); 
        });
    }

    public function down()
    {
        Schema::table('hunting', function (Blueprint $table) {
            $table->dropForeign(['guide_id']);
        });

        Schema::dropIfExists('hunting');
    }
};
