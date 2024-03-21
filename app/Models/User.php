<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function getRoleIdBrowseAttribute()
{
    return $this->role_id ?? 'Candidato';
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nombre',
        'apellidos',
        'telefono',
        'tipo',
        'telefono2',
        'tipo2'
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
        if($this->nombre != ''){
            $nombre = $this->nombre;
        } elseif ($this->name != '') {
            $nombre = $this->name;
        }
        return "{$nombre} {$this->apellidos}";
    }

    public function empresa(): HasOne
    {
        return $this->hasOne(Empresa::class);
    }

    public function estados(): BelongsTo
    {
        return $this->belongsTo(Estado::class,'estado','id');
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'area');
    }

    public function getNombreEmpresaAttribute()
    {
        return "{$this->empresa->empresa}";
    }

    public function scopeCurrentUser($query)
    {
        if (Auth::user()->hasRole('Empresa')) {
            # code...
            return $query->whereNotIn('role_id', [1,3,4,5,6,7,8])->orWhereNull('role_id');
        }
    }
}
