<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleo extends Model
{
    use HasFactory;

    protected $table = 'empleos';

    public function save(array $options = [])
    {
        // If no user has been assigned, assign the current user's id as the user_id of the Emp
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->id;
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
