<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiPemberkasan extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'opsi_pemberkasan';

    public function pemberkasan(){
        return $this->belongsTo(Pemberkasan::class, 'pemberkasan_id', 'id');
    }
}
