<?php

namespace App\Http\Controllers;

use App\Models\AnggotaTim;
use App\Models\Periode;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page');
        $query = Tim::withCount('anggotaTim')->with('periode');
        if (!empty($search)) {
            $query->where('nama', 'ILIKE', "%{$search}%");
        }

        // Ambil data dengan pagination
        $tim = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);

        return view("Manajemen-Tim", compact('user', 'tim', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $tim = Tim::findOrFail($id);
        $users = User::all();
        $anggota = AnggotaTim::where('tim_id', $id)->get(); // Ambil semua user
        return view('Anggota', compact('tim', 'users', 'anggota'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $validatedData = $request->validate([
            'nama' => 'required|string',
            // 'tim_id' => 'required|exists:tim,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // dd($validatedData);
        DB::beginTransaction();
        try {
            // Membuat Tim
            $tim = Tim::create([
                "nama" => $validatedData['nama'],
                'slug' => Str::slug($validatedData['nama']),
            ]);

            // Mengambil data user registrasi
            // Mengambil data user registrasi
            // $registrasi = User::find($validatedData['registrasi_id']);
            // if (!$registrasi) {
            //     return redirect()->back()->with('error', 'Registrasi tidak ditemukan');
            // }

            // Membuat anggota tim
            //  dd($registrasi);
            // $anggotaTim = AnggotaTim::create([
            //     'tim_id' => $tim->id
            // ]);

            // Membuat Periode jika anggota tim berhasil dibuat
            $periode = Periode::create([
                'tim_id' => $tim->id,
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_berakhir' => $validatedData['tanggal_berakhir']
            ]);
            // dd( $periode);
            DB::commit();
            return redirect()->back()->with('success', 'Tim berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat data: ' . $e->getMessage());
        }
    }
    public function indexx($id)
    {
        $tim = Tim::findOrFail($id);
        $registrasi = User::all()->where('role_id', '=', 2);
        $anggota = DB::table('tim')
            ->leftJoin('anggota_tim', 'tim.id', '=', 'anggota_tim.tim_id')
            ->leftJoin('registrasi', 'anggota_tim.registrasi_id', '=', 'registrasi.id')
            ->select(
                'anggota_tim.id as anggota_id',
                'tim.id as tim_id',
                'tim.nama as nama_tim',

                DB::raw("COALESCE(registrasi.nama, 'Belum ada anggota') as nama_anggota"),
                DB::raw("COALESCE(registrasi.username, 'Belum ada anggota') as username")
            )
            ->where('tim.id', $id)
            ->get();
        // dd($anggota);
        // dd($anggota);
        return view("Anggota", compact('registrasi', 'anggota', 'tim'));
    }
    public function storee(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'registrasi_id' => 'required|exists:registrasi,id',
        ]);

        DB::beginTransaction();
        try {
            // Cek apakah user sudah menjadi anggota tim
            $existingMember = AnggotaTim::where('tim_id', $id)
                ->where('registrasi_id', $validatedData['registrasi_id'])
                ->exists();

            if ($existingMember) {
                return redirect()->back()->with('error', 'User sudah menjadi anggota tim.');
            }
            // dd($id)  ;
            // Tambahkan anggota tim
            AnggotaTim::create([
                'tim_id' => (int) $id,
                'registrasi_id' => $validatedData['registrasi_id'],
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Anggota tim berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambah anggota: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function deleteanggota(string $id)
    {
        DB::beginTransaction();
        try {
            $tanah = AnggotaTim::findOrFail($id);
            // dd($subplot_id, Tanah::where('subplot_id', $subplot_id)->first());
            $tanah->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data anggota tim berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data anggota tim: ' . $e->getMessage());
        }
    }
    public function deleteTim(string $id)
    {
        DB::beginTransaction();
        try {
            $tanah = Tim::findOrFail($id);
            // dd($subplot_id, Tanah::where('subplot_id', $subplot_id)->first());
            $tanah->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data tim berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data tim: ' . $e->getMessage());
        }
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
