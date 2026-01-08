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
        Schema::create('pdf_details', function (Blueprint $table) {
        $table->id();
        $table->string('image_url')->nullable(); // Laravel automatically stores path
        $table->string('approved_projects', 50);
        $table->string('pdf')->nullable()->default(null);
        $table->string('password', 20); // Removed collation, handled by DB config
        $table->string('user_id', 50)->unique();
        $table->smallInteger('is_delete')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_details');
    }
};
