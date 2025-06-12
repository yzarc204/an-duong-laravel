<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'is_male',
        'height',
        'weight',
        'latest_glucose',
        'meal_suggestions'
    ];

    protected $appends = [
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'is_male' => 'boolean',
            'date_of_birth' => 'date',
            'meal_suggestions' => 'json',
            'exercise_suggestions' => 'json',
        ];
    }

    public function glucoseRecords()
    {
        return $this->hasMany(GlucoseRecord::class);
    }

    public function getGenderAttribute()
    {
        return $this->is_male ? 'Nam' : 'Nữ';
    }
}
