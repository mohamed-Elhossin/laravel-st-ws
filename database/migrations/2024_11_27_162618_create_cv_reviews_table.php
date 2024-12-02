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
        Schema::create('cv_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId("applicant_id")->references("id")->on("applicants")->onDelete("cascade");
            $table->enum('status', ['waiting', 'rejected','accepted'])->default("waiting");
$table->string("notes")->default("Empty Notes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_reviews');
    }
};
