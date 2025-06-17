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
        Schema::create('leave_usages', function (Blueprint $table) {
            $table->id();
            $table->string('start_date');
            $table->string('end_date');
            $table->enum('type', ['normal', 'urgent', 'sick']);
            $table->string('reason')->nullable();
            $table->foreignId("employee_id")->references("id")->on("employees")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_usages');
    }
};
