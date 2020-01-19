<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('label_name');
            $table->text('place_holder')->nullable();
            $table->integer('min_value')->nullable();
            $table->integer('max_value')->nullable();
            $table->boolean('is_required')->default(false);
            $table->text('options')->nullable();
            $table->unsignedBigInteger('page_id')->index();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
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
        Schema::dropIfExists('page_fields');
    }
}
