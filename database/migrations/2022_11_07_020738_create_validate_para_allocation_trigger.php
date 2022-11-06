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
        //Trigger for safety purposes only para allocation not more than 5 is managed in ParagraphController
        DB::unprepared('
            DROP TRIGGER IF EXISTS validate_para_allocation_trigger;

            CREATE TRIGGER validate_para_allocation_trigger
            BEFORE INSERT ON classifications
            FOR EACH ROW
            BEGIN
                IF (SELECT COUNT(e_id) FROM classifications WHERE doc_id=new.doc_id and paragraph_num = new.paragraph_num) >= 5 THEN
                    SIGNAL SQLSTATE \'HY000\' SET
                        MYSQL_ERRNO=31001,
                        MESSAGE_TEXT=\'Maximum allocation count reached\';
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TRIGGER validate_para_allocation_trigger');
    }
};
