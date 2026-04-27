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
        Schema::table('orders', function (Blueprint $table) {
            // balance_amount: जो पैसा बाद में COD लेना है
            // इसे total_amount के बाद जोड़ रहे हैं
            $table->decimal('balance_amount', 10, 2)->default(0)->after('total_amount');

            // जानकारी के लिए: क्या यह एक Partial Payment वाला ऑर्डर है?
            $table->boolean('is_partial')->default(false)->after('balance_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['balance_amount', 'is_partial']);
        });
    }
};
