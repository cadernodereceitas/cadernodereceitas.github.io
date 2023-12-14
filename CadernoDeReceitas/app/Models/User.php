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
        'email',
        'password',
        'userAdmin',
        'superUser'
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
        'password' => 'hashed',
    ];

    public function rulesLogin()
    {
        return [
            'email' => 'email',
            'password' => 'required|min:4|max:50'
        ];
    }

    public function rulesRegister()
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'required|min:4|max:50'
        ];
    }

    public function feedbackLogin()
    {
        return [
            'email.email' => 'O campo email é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 4 caracteres',
            'password.max' => 'O campo senha deve ter no máximo 50 caracteres',
        ];
    }

    public function feedback()
    {
        return [
            'name.require' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 50 caracteres',
            'email.email' => 'O campo email é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 4 caracteres',
            'password.max' => 'O campo senha deve ter no máximo 50 caracteres',
        ];
    }
}
