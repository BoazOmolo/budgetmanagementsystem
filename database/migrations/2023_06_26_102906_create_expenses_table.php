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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('amount');
            $table->string('fees');
            $table->string('file')->nullable();
            $table->text('status');
            $table->string('createdby');
            $table->string('updatedby');
            $table->timestamps();
            $table->string('deletedby');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
