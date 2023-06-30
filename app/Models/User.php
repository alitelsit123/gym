<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'code',
      'email',
      'bank_name',
      'email_verified_at',
      'password',
      'phone',
      'gender',
      'address',
      'photo',
      'norek',
      'membership_type',
      'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function specialists() {
      return $this->hasMany('App\Models\TrainerSpecialis', 'user_id');
    }
    public function trainerMembers() {
      return $this->hasMany('App\Models\TrainerMember', 'trainer_id');
    }
    public function memberships() {
      return $this->hasMany('App\Models\Membership', 'user_id');
    }
    public function trainerPackets() {
      return $this->hasMany('App\Models\Packet', 'trainer_id');
    }
}
