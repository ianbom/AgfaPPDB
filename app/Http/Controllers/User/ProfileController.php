<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
       $orangtua = Auth::user()->orangtua;
       $user = Auth::user();
       return view('web.orangtua.profile.index', ['orangtua' => $orangtua, 'user' =>  $user]);
    }

    public function updateOrangtua(Request $request)
    {
        $user = Auth::user();
        $orangtua = $user->orangtua;


        $request->validate([
            'email' => 'nullable',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        try {
            $user->name = $request->nama;
            $user->save();


            $orangtua->update(
                [
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]
            );

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function updateAnak(Request $request){
        $user = Auth::user();
        $orangtua = $user->orangtua;

        $request->validate([
            'nama_anak' => 'nullable|string|max:255',
            'profile_anak' => 'nullable|max:15',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('profile_anak')) {
                $imagePath = $request->file('profile_anak')->store('image/anak', 'public');
            } else {
                $imagePath = $user->profile_anak;
            }

            $orangtua->update([
                'nama_anak' => $request->nama_anak,
                'profile_anak' => $imagePath

            ]);

            return redirect()->back()->with('success', 'Data anak berhasil diperbarui');
        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }


    }
}
