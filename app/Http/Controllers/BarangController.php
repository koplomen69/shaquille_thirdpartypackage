<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pageTitle = 'Data Barang';
        $barangs = Barang::whereNull('satuan_barang_id')->get();

        $barangs = DB::table('barangs')
            ->select('barangs.*', 'satuans.nama_satuan as satuan_barang')
            ->leftJoin('satuans', 'barangs.satuan_barang_id', '=', 'satuans.id')
            ->get();

        // Mengambil data barang dari database
        $barangs = barang::all();

        // Mengirimkan data barang ke view
        return view('barang.index', [
            'barangs' => $barangs,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Menampilkan formulir untuk membuat barang baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pageTitle = 'Buat Data Barang';

        $barangs = DB::table('barangs')
            ->select('barangs.*', 'satuans.nama_satuan as satuan_barang')
            ->leftJoin('satuans', 'barangs.satuan_barang_id', '=', 'satuans.id')
            ->get();

        $satuans = Satuan::all(); // Ambil semua satuan untuk ditampilkan dalam dropdown
        return view('barang.create', compact ('satuans', 'pageTitle'));

    }


    /**
     * Menyimpan barang baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {


        $messages = [
            'required' => ':Attribute harus diisi.',
            'unique' => ':Attribute sudah ada.',
            'numeric' => ':Attribute harus berupa angka.',
            'exists' => ':Attribute tidak valid.'
        ];
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'deskripsi_barang' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //elequent
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;
        $barang->satuan_barang_id = $request->satuan_id;
        $barang->save();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah kan.');
    }

    /**
     * Menampilkan detail barang.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\View\View
     */
    public function show(Barang $barang)
    {
        $pageTitle = 'Detail Barang';
        // Mengirimkan data barang ke view
        return view('barang.show', [
            'barang' => $barang,
            'pageTitle' => $pageTitle
        ]);

    }

    /**
     * Menampilkan formulir untuk mengedit barang.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Barang';
        $barang = DB::table('barangs')
            ->select('barangs.*', 'satuans.nama_satuan as satuan_barang')
            ->leftJoin('satuans', 'barangs.satuan_barang_id', '=', 'satuans.id')
            ->where('barangs.id', $id)
            ->first();

        $barang = Barang::findOrFail($id);
        $satuans = Satuan::all();
        return view('barang.edit', [
            'barang' => $barang,
            'satuans' => $satuans,
            'pageTitle' => $pageTitle
        ]);

         // Ambil semua satuan untuk ditampilkan dalam dropdown



    }


    /**
     * Memperbarui barang yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Barang $barang)
{
    // Memvalidasi data yang dikirimkan
    $messages = [
        'required' => ':Attribute harus diisi.',
        'unique' => ':Attribute sudah ada.',
        'numeric' => ':Attribute harus berupa angka.',
        'exists' => ':Attribute tidak valid.'
    ];
    $validator = Validator::make($request->all(), [
        'kode_barang' => 'required|unique:barangs',
        'nama_barang' => 'required',
        'harga_barang' => 'required|numeric',
        'deskripsi_barang' => 'required',

    ], $messages);

    // Cek validasi
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mengumpulkan objek barang dalam collection
    $barangCollection = collect([$barang]);

    // Memperbarui data barang dalam collection
    $barangCollection->each(function ($barang) use ($request) {
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;
        $barang->satuan_barang_id = $request->satuan_id;
    });

    // Menyimpan perubahan
    $barangCollection->each->save();

    // Redirect dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
}


    /**
     * Menghapus barang dari database.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Barang $barang)
    {
        // Menghapus data barang dari database
        $barang->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function rules()
{
    return [
        'nama_barang' => 'required',
        'harga_barang' => 'required',
        'satuan_barang_id' => 'required|exists:satuans,id',
    ];
}
public function __construct()
    {
        $this->middleware('auth');
    }

}
