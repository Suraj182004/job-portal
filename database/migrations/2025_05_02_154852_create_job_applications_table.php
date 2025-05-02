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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The applicant
            $table->foreignId('job_id')->constrained()->onDelete('cascade'); // The job being applied for
            $table->text('cover_letter')->nullable(); // Cover letter text
            $table->string('cv_link')->nullable(); // Link to resume/CV (Google Drive, Dropbox, etc.)
            $table->string('phone')->nullable(); // Contact phone number
            $table->timestamps();

            // Prevent duplicate applications
            $table->unique(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
