<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLanguage extends Model
{
    use HasFactory;

    protected $table = 'user_languages';

    public function idiomas(): BelongsTo
    {
        return $this->belongsTo(Idioma::class,'language','id');
    }
}
