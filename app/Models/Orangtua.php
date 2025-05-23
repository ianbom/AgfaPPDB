<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'orangtua';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function seleksi(){
        return $this->hasOne(Seleksi::class, 'orangtua_id', 'id');
    }
}
