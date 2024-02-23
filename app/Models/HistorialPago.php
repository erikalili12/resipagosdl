<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPagosTable extends Migration
{
    public function up()
    {
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_resident'); // Relación con la tabla de residentes
            $table->foreign('id_resident')->references('id_resident')->on('residentes');
            $table->date('fecha_pago');
            $table->string('concepto');
            $table->string('tipo_pago');
            $table->decimal('cantidad_pagar', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_pagos');
    }
}
