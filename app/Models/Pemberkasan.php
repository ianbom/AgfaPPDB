<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemberkasan extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'pemberkasan';

    public function OpsiPemberkasan(){
        return $this->hasMany(OpsiPemberkasan::class, 'pemberkasan_id', 'id');
    }
}
