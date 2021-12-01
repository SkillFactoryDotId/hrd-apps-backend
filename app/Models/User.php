<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Uuid, Notifiable;

    const ADMIN_ROLE = 'admin';
    const MANAGER_ROLE = 'manager';
    const STAFF_ROLE = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'nomor_karyawan',
        'status',
        'name',
        'email',
        'password',
        'role',
        'status',
        'nomor_karyawan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'nomor_karyawan' => 'string',
        'status' => 'string',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'role' => 'string',
        'email_verified_at' => 'datetime',
    ];


    /**
     * Scope a query to only include admin role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdminRole($query)
    {
        return $query->where('role', self::ADMIN_ROLE);
    }

    /**
     * Scope a query to only include manager role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeManagerRole($query)
    {
        return $query->where('role', self::MANAGER_ROLE);
    }

    /**
     * Scope a query to only include staff role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStaffRole($query)
    {
        return $query->where('role', self::STAFF_ROLE);
    }
}
