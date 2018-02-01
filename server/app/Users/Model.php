<?php

namespace App\Users;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
        }
    }
}
