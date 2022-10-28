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
        Schema::create('classified_labels', function (Blueprint $table) {
            $table->integer('e_id')->unsigned();
            $table->integer('doc_id')->unsigned();
            $table->integer('paragraph_num')->unsigned();
            $table->integer('label_num')->unsigned();

            $table->foreign(['e_id','doc_id','paragraph_num'])->references(['e_id','doc_id','paragraph_num'])->on('classifications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('label_num')->references('label_num')->on('labels')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['e_id','doc_id', 'paragraph_num', 'label_num']);
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
        Schema::dropIfExists('classified_labels');
    }
};
