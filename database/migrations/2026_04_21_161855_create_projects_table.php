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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('url')->nullable();
            $table->string('github_link')->nullable();

            // comma separated technologies
            $table->text('technologies')->nullable();

            $table->string('image')->nullable();

            $table->string('database')->nullable();
            $table->string('framework')->nullable();

            $table->longText('description')->nullable();

            $table->string('video')->nullable();

            $table->date('date')->nullable();

            $table->string('developed_by')->nullable();
            $table->string('author')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};