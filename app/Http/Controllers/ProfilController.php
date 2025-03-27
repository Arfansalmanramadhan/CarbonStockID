<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Http\Resources\ProfilResources;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan ini di bagian atas file controller
use Illuminate\Support\Facades\Storage;

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

        return view('profile', compact('user'));
        // try {
        //     Log::info('Mencari pengguna dengan slug: ' . $slug);

        //     $user = User::where('slug', $slug)->firstOrFail();

        //     Log::info('Data pengguna ditemukan:', $user->toArray());

        //     return view('profile.index', compact('user'));
        // } catch (Exception $e) {
        //     Log::error('Error saat menampilkan profil: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Profil tidak ditemukan.');
        // }
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
    // public function store(Request $request, $id)
    // {
    //     // dd("Haniiifff ");
    //     // dd(Profil::findOrFail($id));
    //     // dd($request->all());
    //     if (User::find($id)) {

    //         try {
    //             // dd("Hanif");
    //             $validatedData = $request->validate([
    //                 'nama_lengkap' => 'required|string|max:255',
    //                 'no_hp' => 'required|string|max:15', // Sesuaikan max sesuai dengan batas panjang no_hp
    //                 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
    //             ], [
    //                 'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
    //                 'image.dimensions' => 'Gambar harus memiliki rasio 1:1.',
    //             ]);

    //             // dd($id);
    //             $User = User::findOrFail($id);

    //             // Jika ada file gambar baru
    //             if ($request->hasFile('image')) {
    //                 $image = $request->file('image');
    //                 $imageName = time() . '.' . $image->getClientOriginalExtension();
    //                 $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

    //                 // Update data profil dengan path gambar baru
    //                 $User->update(array_merge(
    //                     $request->all(),
    //                     ['image' => 'images/users/' . $imageName]
    //                 ));
    //             } else {
    //                 // Update data User tanpa gambar
    //                 $User->update($request->all());
    //             }
    //             // return response()->json([
    //             //     "success" => true,
    //             //     "message" => "Data updated successfully",
    //             //     "data" => $profil
    //             // ], 200);
    //             return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    //         } catch (Exception $e) {
    //             return redirect()->back()->with('error', $e->getMessage());
    //             // return response()->json([
    //             //     "message" => $e->getMessage()
    //             // ], 500);
    //         }
    //     } else {

    //         try {
    //             // dd("Hanif");
    //             // Jika request memiliki file gambar
    //             if ($request->hasFile('image')) {
    //                 $image = $request->file('image');
    //                 $imageName = time() . '.' . $image->getClientOriginalExtension();
    //                 $image->move(public_path('images/profils'), $imageName); // Simpan gambar ke folder public/images/profils

    //                 // Simpan profil dengan path gambar
    //                 $profil = Profil::create(array_merge(
    //                     $request->all(),
    //                     ['image' => 'images/profils/' . $imageName] // Simpan path gambar ke database
    //                 ));
    //             } else {
    //                 // Jika tidak ada gambar
    //                 $profil = Profil::create($request->all());
    //             }
    //             // return response()->json([
    //             //     "sukses" => true,
    //             //     "pesan" => "Data profil berhasil terkirim",
    //             //     "data" => $profil

    //             // ], 200);

    //             // dd($profil);
    //         } catch (Exception $e) {
    //             Log::error('Error saat menyimpan profil: ' . $e->getMessage(), ['exception' => $e]);
    //             return response()->json([
    //                 "pesan"  => $e->getMessage()
    //             ], 500);
    //         }
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = User::findOrFail($id);
        return response()->json([
            "data" => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // dd($request->all());
        try {
            // dd("Hanif");
            $validatedData = $request->validate([
                'nama' => 'sometimes|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
                'nip' => 'nullable|string|max:15',
                'no_hp' => 'nullable|string|max:15', // Sesuaikan max sesuai dengan batas panjang no_hp
                'nik' => 'nullable|string|max:15',
                'foto_ktp' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
                'foto_tandatangan' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            ], [
                'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
                'foto.dimensions' => 'Gambar harus memiliki rasio 1:1.',
            ]);
            // Cari pengguna berdasarkan slug
            $user = User::where('slug', $slug)->firstOrFail();
            // dd($request->all());
            // Mengupdate gambar profil jika ada file gambar baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto) {
                    Storage::delete($user->foto);
                }

                // Simpan foto baru
                $image = $request->file('foto');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/profils'), $imageName);
                $validatedData['foto'] = 'images/profils/' . $imageName;
            }

            // Mengupdate foto KTP jika ada file baru
            if ($request->hasFile('foto_ktp')) {
                // Hapus foto KTP lama jika ada
                if ($user->foto_ktp) {
                    Storage::delete($user->foto_ktp); // Menghapus file lama
                }

                // Simpan foto KTP baru
                $ktpImage = $request->file('foto_ktp');
                $ktpImageName = time() . '.' . $ktpImage->getClientOriginalExtension();
                $ktpImage->move(public_path('images/ktp'), $ktpImageName);
                $validatedData['foto_ktp'] = 'images/ktp/' . $ktpImageName;
            }
            // Mengupdate foto KTP jika ada file baru
            if ($request->hasFile('foto_tandatangan')) {
                // Hapus foto KTP lama jika ada
                if ($user->foto_tandatangan) {
                    Storage::delete($user->foto_tandatangan); // Menghapus file lama
                }

                // Simpan foto KTP baru
                $ktpImage = $request->file('foto_tandatangan');
                $ktpImageName = time() . '.' . $ktpImage->getClientOriginalExtension();
                $ktpImage->move(public_path('images/ktp'), $ktpImageName);
                $validatedData['foto_tandatangan'] = 'images/ktp/' . $ktpImageName;
            }

            // Update data pengguna
            $user->update($validatedData);
            // dd( $user);
            // return response()->json([
            //     "success" => true,
            //     "message" => "Data updated successfully",
            //     "data" => $User
            // ], 200);
            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
            // return redirect()->route('profile.index', ['slug' => $User->slug])->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            // return response()->json([
            //     "message" => $e->getMessage()
            // ], 500);
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui profil.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data Profil berdasarkan ID
            $Profil = User::findOrFail($id);

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
