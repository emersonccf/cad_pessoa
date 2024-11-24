<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER before_insert_pessoas_fisicas
            BEFORE INSERT ON pessoas_fisicas
            FOR EACH ROW
            BEGIN
                DECLARE pessoa_juridica_exists INT;

                SELECT COUNT(*) INTO pessoa_juridica_exists
                FROM pessoas_juridicas
                WHERE pessoa_id = NEW.pessoa_id;

                IF pessoa_juridica_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "A pessoas já está cadastrada como Pessoa Jurídica!";
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER before_insert_pessoas_juridicas
            BEFORE INSERT ON pessoas_juridicas
            FOR EACH ROW
            BEGIN
                DECLARE pessoa_fisica_exists INT;

                SELECT COUNT(*) INTO pessoa_fisica_exists
                FROM pessoas_fisicas
                WHERE pessoa_id = NEW.pessoa_id;

                IF pessoa_fisica_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "A pessoas já está cadastrada como Pessoa Física!";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_pessoas_fisicas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_pessoas_juridicas');
    }
};
