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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni')->primary()->comment('Documento de identidad');
            $table->unsignedBigInteger('id_reg');
            $table->foreign('id_reg')->references('id_reg')->on('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_com');
            $table->foreign('id_com')->references('id_com')->on('communes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('email')->unique()->comment('Correo electronico');
            $table->string('name')->comment('Nombre');
            $table->string('last_name')->comment('Apellido');
            $table->string('address')->comment('Direccion')->nullable();
            $table->dateTime('date_reg')->comment('Fecha y hora del registro');
            $table->enum('status', ['A', 'I', 'trash'])->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
