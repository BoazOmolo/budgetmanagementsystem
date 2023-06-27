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
        CREATE TRIGGER insert_file_trigger_budgets AFTER INSERT ON budgets FOR EACH ROW
        BEGIN
            INSERT INTO files (type_id, type, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Budgets", "1", "", "", NOW(), NOW());
        END;

        CREATE TRIGGER insert_file_trigger_expenses AFTER INSERT ON expenses FOR EACH ROW
        BEGIN
            INSERT INTO files (type_id, type, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Expenses", "1", "", "", NOW(), NOW());
        END;

        CREATE TRIGGER insert_file_trigger_incomes AFTER INSERT ON incomes FOR EACH ROW
        BEGIN
            INSERT INTO files (type_id, type, status, createdby, updatedby, created_at, updated_at)
            VALUES (NEW.id, "Incomes", "1", "", "", NOW(), NOW());
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
