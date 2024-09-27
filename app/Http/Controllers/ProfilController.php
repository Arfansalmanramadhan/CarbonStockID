<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Http\Resources\ProfilResources;
use App\Models\Profil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan ini di bagian atas file controller

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = Profil::with('user:id,username,email')->get();
        // return  ProfilResources::collection($user);

        // Mengambil data pengguna yang sedang login
        // $user = Auth::user();
        // // dd($user);

        // // Menampilkan halaman profil dengan data pengguna
        // return view('profile', ['user' => $user]);
        $user = Auth::user(); // Ambil pengguna yang sedang login
        $profil = Profil::where('registrasi_id', $user->id)->first(); // Ambil profil berdasarkan user

        return view('profile', compact('user', 'profil'));
        $profil = Profil::where('registrasi_id', $user?->id)->first(); // Ambil profil berdasarkan user
        return view('profile', compact('user', 'profil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // dd("Haniiifff ");
        // dd(Profil::findOrFail($id));
        // dd($request->all());
        if (Profil::find($id)) {

            try {
                // dd("Hanif");
                $validatedData = $request->validate([
                    'nama_lengkap' => 'required|string|max:255',
                    'no_hp' => 'required|string|max:15', // Sesuaikan max sesuai dengan batas panjang no_hp
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
                ], [
                    'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
                    'image.dimensions' => 'Gambar harus memiliki rasio 1:1.',
                ]);

                // dd($id);
                $profil = Profil::findOrFail($id);

                // Jika ada file gambar baru
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

                    // Update data profil dengan path gambar baru
                    $profil->update(array_merge(
                        $request->all(),
                        ['image' => 'images/profils/' . $imageName]
                    ));
                } else {
                    // Update data profil tanpa gambar
                    $profil->update($request->all());
                }
                // return response()->json([
                //     "success" => true,
                //     "message" => "Data updated successfully",
                //     "data" => $profil
                // ], 200);
                return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
                // return response()->json([
                //     "message" => $e->getMessage()
                // ], 500);
            }
        } else {

            try {
                // dd("Hanif");
                // Jika request memiliki file gambar
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

                    // Simpan profil dengan path gambar
                    $profil = Profil::create(array_merge(
                        $request->all(),
                        ['image' => 'images/profils/' . $imageName] // Simpan path gambar ke database
                    ));
                } else {
                    // Jika tidak ada gambar
                    $profil = Profil::create($request->all());
                }
                // return response()->json([
                //     "sukses" => true,
                //     "pesan" => "Data profil berhasil terkirim",
                //     "data" => $profil

                // ], 200);

                // dd($profil);
            } catch (Exception $e) {
                Log::error('Error saat menyimpan profil: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json([
                    "pesan"  => $e->getMessage()
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profil = Profil::with('user:id,username,email')->findOrFail($id);
        return new ProfilResources($profil);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Profil::findOrFail($id);
        return response()->json([
            "data" => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            // dd("Hanif");
            $validatedData = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15', // Sesuaikan max sesuai dengan batas panjang no_hp
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
            ], [
                'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
                'image.dimensions' => 'Gambar harus memiliki rasio 1:1.',
            ]);
            // dd($id);
            $profil = Profil::findOrFail($id);

            // Jika ada file gambar baru
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

                // Update data profil dengan path gambar baru
                $profil->update(array_merge(
                    $request->all(),
                    ['image' => 'images/profils/' . $imageName]
                ));
            } else {
                // Update data profil tanpa gambar
                $profil->update($request->all());
            }
            // return response()->json([
            //     "success" => true,
            //     "message" => "Data updated successfully",
            //     "data" => $profil
            // ], 200);
            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            // return response()->json([
            //     "message" => $e->getMessage()
            // ], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data Profil berdasarkan ID
            $Profil = Profil::findOrFail($id);

            // Hapus data
            $Profil->delete();

            // Response sukses
            return response()->json([
                'message' => 'Profil berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal menghapus Profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
