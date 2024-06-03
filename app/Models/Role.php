<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \TCG\Voyager\Models\Role
{
    use HasFactory;

    public function scopeAdminMV($query)
    {
        if (Auth::user()->hasRole('adminmv')) {
            # code...
            return $query->whereIn('id', [3]);
        }
    }

    public function scopeAdminMV2($query)
    {
        if (Auth::user()->hasRole('adminmv')) {
            # code...
            return $query->whereIn('id', [4,5,6,7]);
        }
    }
}
