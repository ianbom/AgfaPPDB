<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpsiPemberkasan;
use App\Models\Pemberkasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemberkasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemberkasan = Pemberkasan::all();
        return view('web.admin.pemberkasan.index', ['pemberkasan' => $pemberkasan]);
    }

    public function create()
    {
        return view('web.admin.pemberkasan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'soal' => 'required|string|max:65535',
            'tipe' => 'required|in:text,radio,checkbox,file',
            'opsi' => 'required_if:tipe,radio,checkbox|array',
            'opsi.*' => 'required|string|max:255'
        ]);

        DB::beginTransaction();

        try {

            $pemberkasan = Pemberkasan::create([
                'soal' => $validated['soal'],
                'tipe' => $validated['tipe']
            ]);

            if (in_array($validated['tipe'], ['radio', 'checkbox'])) {
                foreach ($validated['opsi'] as $opsiText) {
                    OpsiPemberkasan::create([
                        'pemberkasan_id' => $pemberkasan->id,
                        'opsi' => $opsiText
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.pemberkasan.index')
                ->with('success', 'Pemberkasan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan pemberkasan: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemberkasan $pemberkasan)
    {
        return view('web.admin.pemberkasan.edit', ['pemberkasan' => $pemberkasan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemberkasan $pemberkasan)
{
    $validated = $request->validate([
        'soal' => 'required|string|max:65535',
        'tipe' => 'required|in:text,radio,checkbox,file',
        'opsi' => 'required_if:tipe,radio,checkbox|array',
        'opsi.*' => 'required|string|max:255'
    ]);

    DB::beginTransaction();

    try {
        // Update data pemberkasan
        $pemberkasan->update([
            'soal' => $validated['soal'],
            'tipe' => $validated['tipe']
        ]);

        // Hapus semua opsi lama
        $pemberkasan->opsiPemberkasan()->delete();

        // Jika tipe radio/checkbox, buat opsi baru
        if (in_array($validated['tipe'], ['radio', 'checkbox'])) {
            foreach ($validated['opsi'] as $opsiText) {
                OpsiPemberkasan::create([
                    'pemberkasan_id' => $pemberkasan->id,
                    'opsi' => $opsiText
                ]);
            }
        }

        DB::commit();

        return redirect()->route('admin.pemberkasan.index')
            ->with('success', 'Pemberkasan berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
            ->with('error', 'Gagal memperbarui pemberkasan: '.$e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
