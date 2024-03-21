<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;

    public $additional_attributes = ['full_estudio'];

    public function getFullEstudioAttribute()
    {
        switch ($this->estudio) {
            case 0:
                $est = "Educación Primaria";
                break;
            case 1:
                $est = "Educación secundaria";
                break;
            case 2:
                $est = "Educación media superior -Bachillerato General";
                break;
            case 3:
                $est = "Educación media superior - Educación Profesional Tecnológica";
                break;
            case 4:
                $est = "Educación media superior - Bachillerato Tecnológico";
                break;
            case 5:
                $est = "Educación superior - Licenciatura";
                break;
            case 6:
                $est = "Educación superior - Especialidad";
                break;
            case 7:
                $est = "Educación superior - Maestría";
                break;
            case 8:
                $est = "Educación superior - Doctorado";
                break;
        }
        return "{$est} - {$this->institucion}";
    }
}
