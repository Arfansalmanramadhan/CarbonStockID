<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Http\Resources\ProfilResources;
use App\Models\Profil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        // dd($user);
        
        // Menampilkan halaman profil dengan data pengguna
        return view('profile', ['user' => $user]);
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
    public function store(ProfilRequest $request)
    {
        try {
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
            return response()->json([
                "sukses" => true,
                "pesan" => "Data profil berhasil terkirim",
                "data" => $profil
            ], 200);
            // dd($profil);
        } catch (Exception $e) {
            return response()->json([
                "pesan"  => $e->getMessage()
            ], 500);
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
    // public function update(Request $request, string $id)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'nama_lengkap' => "required",
    //             'no_hp' => 'required',
    //             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
    //             'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
    //             'image.dimensions' => 'Gambar harus memiliki rasio 1:1.',
    //         ]);
    //         $profil = Profil::findOrFail($id);

    //         // Jika ada file gambar baru
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

    //             // Update data profil dengan path gambar baru
    //             $profil->update(array_merge(
    //                 $request->all(),
    //                 ['image' => 'images/profils/' . $imageName]
    //             ));
    //         } else {
    //             // Update data profil tanpa gambar
    //             $profil->update($request->all());
    //         }
    //         return response()->json([
    //             "success" => true,
    //             "message" => "Data updated successfully",
    //             "data" => $profil
    //         ], 200);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             "message" => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Ambil user saat ini
            $user = Auth::user();

            // Update nama dan nomor telepon
            $user->name = $request->input('full_name');
            $user->phone = $request->input('phone');

            // Jika ada gambar yang diupload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/profils'), $imageName); // Simpan gambar

                // Update path gambar ke database
                $user->image = 'images/profils/' . $imageName;
            }

            // Simpan perubahan
            $user->save();

            // Kirim respons sukses
            return response()->json([
                'sukses' => true,
                'pesan' => 'Profil berhasil diperbarui',
                'data' => $user
            ], 200);

        } catch (Exception $e) {
            // Kirim respons error jika gagal
            return response()->json([
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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
