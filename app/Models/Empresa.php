<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory, Translatable;

    protected $table = 'empresas';

    protected $translatable = ['title', 'body'];

    public function save(array $options = [])
    {
        // If no user has been assigned, assign the current user's id as the user_id of the Emp
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->id;
            $this->fecha_vencimiento = '2024-03-01';
        }


        parent::save();


    }

    public function scopeCurrentUser($query)
    {
        if (!Auth::user()->hasRole('Admin')) {
            # code...
            return $query->where('user_id', Auth::user()->id);
        }
    }

}
