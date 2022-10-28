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
        DB::unprepared('
            DROP TRIGGER IF EXISTS `paragraph_allocation_block_trigger`;

            CREATE TRIGGER `paragraph_allocation_block_trigger` AFTER INSERT ON `classifications` FOR EACH ROW BEGIN
                IF ( 	Select count(e_id) from classifications
                        where paragraph_num=NEW.paragraph_num and doc_id=NEW.doc_id ) >= 5 THEN
                                    Update paragraphs
                                    Set is_blocked=true
                                    Where doc_id=NEW.doc_id and paragraph_num=NEW.paragraph_num;
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
        DB::statement('DROP TRIGGER paragraph_allocation_block_trigger');
    }
};
