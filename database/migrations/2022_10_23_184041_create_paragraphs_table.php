<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paragraphs', function (Blueprint $table) {
            $table->integer('doc_id')->unsigned();
            $table->integer('paragraph_num')->unsigned();
            $table->longText('content');
            $table->integer('page');
            $table->boolean('is_blocked')->default(false);
            $table->foreign('doc_id')->references('doc_id')->on('documents')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['doc_id', 'paragraph_num']);
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
        Schema::dropIfExists('paragraphs');
    }
};
