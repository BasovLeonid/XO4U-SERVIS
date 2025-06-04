<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('telegram_username')->nullable()->after('phone');
            $table->string('last_auth_method')->nullable()->after('telegram_username');
            $table->decimal('balance', 10, 2)->default(0)->after('last_auth_method');
            $table->decimal('total_spent', 10, 2)->default(0)->after('balance');
            $table->integer('repeat_purchases')->default(0)->after('total_spent');
            $table->decimal('payment_rating', 5, 2)->default(0)->after('repeat_purchases');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'telegram_username',
                'last_auth_method',
                'balance',
                'total_spent',
                'repeat_purchases',
                'payment_rating'
            ]);
        });
    }
}; 