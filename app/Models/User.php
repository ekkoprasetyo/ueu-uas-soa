<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = array();
    public $timestamps = false;
    protected $hidden = ['password','token_bearer'];

    public static function userByEmail($email) {
        return User::where('email', $email)
            ->first();
    }
}
