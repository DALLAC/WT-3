<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('studio_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('studio_id')
                ->constrained('studios')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('text');

            $table->timestamps();

            $table->index(['studio_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studio_comments');
    }
};