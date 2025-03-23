<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pemberkasan;
use App\Models\Seleksi;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seleksi = Seleksi::with('orangtua')->get();

        $orangtuaIds = $seleksi->pluck('orangtua.id')->filter()->toArray();
        $totalBerkas = Pemberkasan::count();
        $totalJawaban = Jawaban::whereIn('orangtua_id', $orangtuaIds)
            ->selectRaw('orangtua_id, COUNT(*) as total')
            ->groupBy('orangtua_id')
            ->pluck('total', 'orangtua_id')
            ->toArray();

        return view('web.admin.seleksi.index', [
            'seleksi' => $seleksi,
            'totalJawaban' => $totalJawaban,
            'totalBerkas' => $totalBerkas
        ]);
    }


    public function bulkUpdateSeleksi(Request $request){

        try {
            $request->validate([
                'selected_ids' => 'required|array',
                'selected_ids.*' => 'exists:users,id',
                'status' => 'required|string'
            ]);

            Seleksi::whereIn('id', $request->selected_ids)->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Status berhasil diubah');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seleksi $seleksi)
    {
        $orangtua = $seleksi->orangtua;
        $pemberkasan = Pemberkasan::all();
        $jawaban = Jawaban::where('orangtua_id', $orangtua->id)->get();
        // return response()->json(['jawaban' => $jawaban]);

        return view('web.admin.seleksi.detail', ['seleksi' => $seleksi, 'orangtua' => $orangtua, 'jawaban' => $jawaban, 'pemberkasan' => $pemberkasan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
