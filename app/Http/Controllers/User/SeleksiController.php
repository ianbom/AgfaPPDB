<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeleksiController extends Controller
{
    public function index(){
        $user = Auth::user();
        $orangtua = $user->orangtua;
        $seleksi = Seleksi::where('orangtua_id', $orangtua->id)->first();
        return view('web.orangtua.seleksi.index', ['seleksi' => $seleksi]);
    }
}
