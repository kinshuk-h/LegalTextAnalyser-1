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
        Schema::create('classifications', function (Blueprint $table) {
            $table->integer('e_id')->unsigned();
            $table->integer('doc_id')->unsigned();
            $table->integer('paragraph_num')->unsigned();
            $table->timestamp('allocation_time')->useCurrent();
            $table->timestamp('labeled_time')->nullable();
            $table->enum('status', array('alloted', 'labeled' , 'timesup', 'bypass','modified'))->default('alloted');

            $table->primary(['e_id','doc_id', 'paragraph_num']);
            $table->foreign('e_id')->references('id')->on('experts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['doc_id','paragraph_num'])->references(['doc_id','paragraph_num'])->on('paragraphs')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
    }
};
