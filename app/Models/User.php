<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded= ['id'];

    // protected $fillable = ['jatah_cuti', /* kolom lain */];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->last_name)) {
            return "{$this->name}";
        }

        return "{$this->name} {$this->last_name}";
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    // public function division()
    // {
    //     return $this->belongsTo(Divisions::class);
    // }
    public function divisions()
    {
        return $this->belongsToMany(Divisions::class, 'user_division', 'user_id', 'division_id')->withTimestamps();
    }
    public function position()
    {
        return $this->belongsTo(Positions::class);
    }
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }

    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'user_permissions', 'user_id', 'permission_id');
}
public function approvedPengajuanCutis()
    {
        return $this->hasMany(PengajuanCuti::class, 'approved_by');
    }

    public function pengajuanCutis()
    {
        return $this->hasMany(PengajuanCuti::class, 'karyawan_id');
    }
}
