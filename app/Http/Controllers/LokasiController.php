<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi; // Changed from Jabatan
use DataTables;
use Alert;
use Session;

class LokasiController extends Controller // Changed from JabatanController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Changed view path
        return view('masterdata.lokasi.index');
    }

    /**
     * Get data for DataTables.
     */
    public function getLokasi(Request $request) // Changed from getJabatan
    {
        if ($request->ajax()) {
            $lokasi = Lokasi::all(); // Changed from Jabatan
            return DataTables::of($lokasi) // Changed from $jabatan
                ->editColumn('aksi', function ($lokasi) { // Changed from $jabatan
                    return view('partials._action', [
                        'model' => $lokasi, // Changed from $jabatan
                        'form_url' => route('lokasi.destroy', $lokasi->id), // Changed from jabatan.destroy
                        'edit_url' => route('lokasi.edit', $lokasi->id),     // Changed from jabatan.edit
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Changed view path
        return view('masterdata.lokasi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input based on the 'lokasi' table structure
        $this->validate($request, [
            'nama_lokasi' => 'required', // Changed from nama_jabatan and others
        ]);

        // Insert data into the database
        Lokasi::create($request->all()); // Changed from Jabatan

        Alert::success('Sukses', 'Berhasil Menambahkan Lokasi Baru'); // Changed message
        return redirect()->route('lokasi.index'); // Changed route
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Typically not used in a standard CRUD setup like this, can be left empty
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi) // Changed from Jabatan $jabatan
    {
        // Changed view path and variable
        return view('masterdata.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lokasi $lokasi) // Changed from Jabatan $jabatan
    {
        // Validate the input based on the 'lokasi' table structure
        $this->validate($request, [
            'nama_lokasi' => 'required', // Changed from nama_jabatan and others
        ]);

        // Update data in the database
        $lokasi->update($request->all()); // Changed variable

        Alert::success('Sukses', 'Berhasil Mengupdate Lokasi'); // Changed message
        return redirect()->route('lokasi.index'); // Changed route
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi) // Changed from Jabatan $jabatan
    {
        // The delete() method is called on the model instance.
        $lokasi->delete(); // Simplified from $jabatan->destroy($jabatan->id)

        Alert::success('Sukses', 'Berhasil Menghapus Lokasi'); // Changed message
        return redirect()->route('lokasi.index'); // Changed route
    }
}