<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'jawaban';

    public function orangtua(){
        return $this->belongsTo(Orangtua::class, 'orangtua_id', 'id');
    }

    public function pemberkasan(){
        return $this->belongsTo(Pemberkasan::class, 'pemberkasan_id', 'id');
    }
}
