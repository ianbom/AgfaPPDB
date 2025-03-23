<?php

namespace App\Http\Controllers\User;

use App\Models\Pemberkasan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\OpsiPemberkasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PemberkasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $orangtua_id = Auth::user()->orangtua->id;
        $pemberkasan = Pemberkasan::all();
        $jawaban = Jawaban::where('orangtua_id', $orangtua_id)->get()->keyBy('pemberkasan_id'); 
        $totalPemberkasan = Pemberkasan::count(); 
        $totalJawaban = Jawaban::where('orangtua_id', $orangtua_id)->count();
        //  return response()->json(['totalJawaban' => $totalJawaban]);
        return view('web.orangtua.pemberkasan.index', ['pemberkasan' => $pemberkasan, 'jawaban' => $jawaban, 'totalPemberkasan' => $totalPemberkasan, 'totalJawaban'=> $totalJawaban]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $orangtua = Auth::user()->orangtua;
            $pemberkasan = Pemberkasan::findOrFail($request->pemberkasan_id);

            $validationRules = [];
            $jawabanData = null;

            switch ($pemberkasan->tipe) {
                case 'text':
                    $validationRules['jawaban'] = ['required', 'string', 'max:65535'];
                    $jawabanData = $request->jawaban;
                    break;

                case 'radio':
                    $validationRules['jawaban'] = [
                        'required',
                        // Rule::exists('opsi_pemberkasan', 'id')->where('pemberkasan_id', $pemberkasan->id)
                    ];
                    // $opsi = OpsiPemberkasan::findOrFail($request->jawaban);
                    $jawabanData = $request->jawaban;
                    break;

                case 'checkbox':
                    $validationRules['jawaban'] = [
                        'required',
                        'array',
                        // Rule::exists('opsi_pemberkasan', 'id')->where('pemberkasan_id', $pemberkasan->id)
                    ];

                    // return response($request->jawaban);
                    // $opsi = OpsiPemberkasan::whereIn('id', $request->jawaban)->pluck('opsi')->toArray();

                    $jawabanData = json_encode($request->jawaban);
                    break;

                case 'file':
                    $validationRules['jawaban'] = [
                        'required',
                        'file',
                        'max:2048'
                    ];
                    break;

                default:
                    throw new \Exception('Tipe pemberkasan tidak valid');
            }

            $validated = $request->validate($validationRules);

            // Handle file upload
            if ($pemberkasan->tipe === 'file') {
                $file = $request->file('jawaban');
                $path = $file->store('jawaban_files', 'public');
                $jawabanData = $path;
            }

            $existingJawaban = Jawaban::where('orangtua_id', $orangtua->id)
                ->where('pemberkasan_id', $pemberkasan->id)
                ->first();

            if ($existingJawaban) {

                $existingJawaban->update(['jawaban' => $jawabanData]);
            } else {
                // Create new
                Jawaban::create([
                    'orangtua_id' => $orangtua->id,
                    'pemberkasan_id' => $pemberkasan->id,
                    'jawaban' => $jawabanData
                ]);
            }

            DB::commit();

            return redirect()->route('orangtua.pemberkasan.index')
                ->with('success', 'Jawaban berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan jawaban: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemberkasan $pemberkasan)
    {
        return view('web.orangtua.pemberkasan.create', ['pemberkasan' => $pemberkasan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {    $jawaban = Jawaban::findOrFail($id);
        // return response()->json(['jawaban' => $jawaban]);

        return view('web.orangtua.pemberkasan.edit', [
            'jawaban' => $jawaban, 
            'pemberkasan' => $jawaban->pemberkasan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    DB::beginTransaction();
    try {
        $jawaban = Jawaban::findOrFail($id);
        $orangtua = Auth::user()->orangtua;
        $pemberkasan = $jawaban->pemberkasan;

        // Validasi kepemilikan jawaban
        // if ($jawaban->orangtua_id !== $orangtua->id) {
        //     throw new \Exception('Anda tidak memiliki akses untuk mengubah jawaban ini');
        // }

        $validationRules = [];
        $jawabanData = null;

        switch ($pemberkasan->tipe) {
            case 'text':
                $validationRules['jawaban'] = ['required', 'string', 'max:65535'];
                $jawabanData = $request->jawaban;
                break;

            case 'radio':
                $validationRules['jawaban'] = [
                    'required',
                    Rule::exists('opsi_pemberkasan', 'id')->where('pemberkasan_id', $pemberkasan->id)
                ];
                $opsiTerpilih = OpsiPemberkasan::where('id', $request->jawaban)->pluck('opsi');
                $jawabanData = $opsiTerpilih;
                break;

            case 'checkbox':
                $validationRules['jawaban'] = [
                    'required',
                    'array',
                    Rule::exists('opsi_pemberkasan', 'id')->where('pemberkasan_id', $pemberkasan->id)
                ];
                $opsiTerpilih = OpsiPemberkasan::whereIn('id', $request->jawaban)
                    ->pluck('opsi')
                    ->toArray();
                $jawabanData = json_encode($opsiTerpilih);
                break;

            case 'file':
                $validationRules['jawaban'] = [
                    'nullable',
                    'file',
                    'max:2048'
                ];
                break;

            default:
                throw new \Exception('Tipe pemberkasan tidak valid');
        }

        $validated = $request->validate($validationRules);

        // Handle file upload
        if ($pemberkasan->tipe === 'file' && $request->hasFile('jawaban')) {
            // Hapus file lama jika ada
            if ($jawaban->jawaban && Storage::disk('public')->exists($jawaban->jawaban)) {
                Storage::disk('public')->delete($jawaban->jawaban);
            }
            
            $file = $request->file('jawaban');
            $path = $file->store('jawaban_files', 'public');
            $jawabanData = $path;
        } elseif ($pemberkasan->tipe === 'file') {
            // Jika tidak upload file baru, tetap gunakan yang lama
            $jawabanData = $jawaban->jawaban;
        }

        $jawaban->update(['jawaban' => $jawabanData]);

        DB::commit();

        return redirect()->route('orangtua.pemberkasan.index')
            ->with('success', 'Jawaban berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal memperbarui jawaban: '.$e->getMessage());
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
