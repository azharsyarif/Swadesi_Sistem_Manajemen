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
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->string('model_type');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade');

            // Anda mungkin perlu menyesuaikan nama tabel dan kunci asing di atas sesuai dengan aplikasi Anda

            $table->index(['model_id', 'model_type', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_roles');
    }
};
