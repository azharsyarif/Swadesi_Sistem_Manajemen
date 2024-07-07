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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('No_Order')->constrained('orders')->onDelete('cascade');
            $table->foreignId('No_Po_Customer')->constrained('orders')->onDelete('cascade');
            $table->string('No_Inv')->unique();
            $table->date('Tanggal_Kirim_Inv');
            $table->foreignId('term_agrement')->constrained('rekanans')->onDelete('cascade');
            $table->decimal('Biaya_Operasional', 10, 2);
            $table->decimal('Revenue', 10, 2);
            $table->decimal('Net_Income', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
