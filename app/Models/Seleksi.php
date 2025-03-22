<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'seleksi';

    public function orangtua(){
        return $this->belongsTo(Orangtua::class, 'orangtua_id', 'id');
    }
}
