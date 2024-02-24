<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Agregar los valores de $additional_attributes de la clase VoyagerUser
        $this->additional_attributes[] = 'full_name';
        $this->additional_attributes[] = 'nombre_empresa';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellidos}";
    }
    
    public function empresa(): HasOne
    {
        return $this->hasOne(Empresa::class);
    }
    
    public function getNombreEmpresaAttribute()
    {
        return "{$this->empresa->empresa}";
    }
}
