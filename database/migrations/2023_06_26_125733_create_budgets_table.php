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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
            $table->unsignedBigInteger('expenses_id')->index()->nullable();
            $table->foreign('expenses_id')->references('id')->on('expenses')->onDelete('cascade');
            $table->string('file');
            $table->text('status');
            $table->string('createdby');
            $table->string('updatedby');
            $table->timestamps();
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
        Schema::dropIfExists('budgets');
    }
};
