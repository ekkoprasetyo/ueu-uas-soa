<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $guarded = array();
    public $timestamps = false;

    public static function my_absensi($id) {
        return Absensi::select('absensi.id', 'users.name','date','absensi.created_at','absensi.status')
            ->where('user_id', $id)
            ->leftJoin('users', 'absensi.user_id', '=', 'users.id')
            ->get();
    }
}
