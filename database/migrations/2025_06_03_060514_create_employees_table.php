<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("position");
            $table->string("salary");
            $table->string("birth_date")->nullable();
            $table->string("join_date");
            $table->string("end_date");
            $table->enum("type", ['employee','admin'])->default("employee");
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("department_id")->references("id")->on("departments")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
