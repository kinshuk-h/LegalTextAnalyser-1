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
            DROP PROCEDURE IF EXISTS update_paragraph_labeling_status_procedure;

            CREATE PROCEDURE update_paragraph_labeling_status_procedure()
            BEGIN  
                Update classifications as c
                Set c.status=\'timesup\'
                Where c.status=\'alloted\' AND c.allocation_time < NOW() - INTERVAL 1 HOUR AND e_id <> 0 ;   
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
        DB::statement('DROP PROCEDURE update_paragraph_labeling_status_procedure');
    }
};
