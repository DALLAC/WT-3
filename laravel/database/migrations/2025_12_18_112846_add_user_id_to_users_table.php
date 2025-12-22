<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('studios', function (Blueprint $table) {
        // user_id может быть nullable, чтобы старые записи не падали
        $table->foreignId('user_id')
            ->nullable()
            ->constrained()      // по умолчанию ->references('id')->on('users')
            ->nullOnDelete();    // при удалении пользователя user_id станет NULL
    });
}

public function down(): void
{
    Schema::table('studios', function (Blueprint $table) {
        $table->dropConstrainedForeignId('user_id');
    });
}
};
