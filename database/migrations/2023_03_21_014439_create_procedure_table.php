<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `gradesById`;
            CREATE PROCEDURE `gradesById` (IN users_id int)
            BEGIN 
            SELECT users.name, users.username, grades.grade, grades.position FROM users JOIN grades ON users.grades_id = grades.id WHERE users.id =  users_id;
            END;";
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
