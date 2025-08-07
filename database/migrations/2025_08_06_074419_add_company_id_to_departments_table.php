<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            // Add the company_id column, making it a foreign key.
            // It's nullable for now to avoid issues with existing records.
            // You can decide if it should be required later.
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            // Drop the foreign key constraint and the column.
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
