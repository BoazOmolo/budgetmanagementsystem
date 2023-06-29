<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        CREATE TRIGGER insert_file_trigger_budgets AFTER INSERT ON budgets FOR EACH ROW
        BEGIN
            DECLARE file_name VARCHAR(255);
            SELECT name INTO file_name FROM budgets WHERE id = NEW.id;
            INSERT INTO files (type_id, type, file_name, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Budgets", file_name, "1", NEW.createdby, "", NOW(), NOW());
        END;

        CREATE TRIGGER insert_file_trigger_expenses AFTER INSERT ON expenses FOR EACH ROW
        BEGIN
            DECLARE file_name VARCHAR(255);
            SELECT name INTO file_name FROM expenses WHERE id = NEW.id;
            INSERT INTO files (type_id, type, file_name, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Expenses", file_name, "1", NEW.createdby, "", NOW(), NOW());
        END;

        CREATE TRIGGER insert_file_trigger_incomes AFTER INSERT ON incomes FOR EACH ROW
        BEGIN
            DECLARE file_name VARCHAR(255);
            SELECT name INTO file_name FROM incomes WHERE id = NEW.id;
            INSERT INTO files (type_id, type, file_name, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Incomes", file_name, "1", NEW.createdby, "", NOW(), NOW());
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
        DB::unprepared('DROP TRIGGER IF EXISTS insert_file_trigger_budgets');
        DB::unprepared('DROP TRIGGER IF EXISTS insert_file_trigger_expenses');
        DB::unprepared('DROP TRIGGER IF EXISTS insert_file_trigger_incomes');
    }
};
