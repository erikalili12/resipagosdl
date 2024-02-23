<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residentes extends Model
{
    //use HasFactory;
    protected $table="residentes";
    protected $primaryKey="id_resident";
    protected $fillable= [
    'apellidos', 'nombre', 'domicilio', 'fecha_de_pago','concepto','tipo_pago','cantidad_pagar'
];
public $timestamps = false;
}


class Residente extends Model
{
    // Otras propiedades y métodos del modelo

    public function historialPagos()
    {
        return $this->hasMany(HistorialPago::class, 'id_resident', 'id_resident');
    }
}
