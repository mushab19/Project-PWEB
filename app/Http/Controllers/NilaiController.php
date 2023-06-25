<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index() //Nama method bebas
    {
    	// mengambil data dari table pegawai
    	$nilaikuliah = DB::table('nilaikuliah')->get();

        // mengambil data dari table pegawai per page
        $nilaikuliah = DB::table('nilaikuliah')->paginate(3);

    	// mengirim data pegawai ke view index
    	return view('indexNilai',['nilaikuliah' => $nilaikuliah]);

    }
    public function tambah()
    {

	// memanggil view tambah
	return view('tambah');

    }
    public function store(Request $request)
    {
	// insert data ke table pegawai
	DB::table('pegawai')->insert([
		'pegawai_nama' => $request->nama,
		'pegawai_jabatan' => $request->jabatan,
		'pegawai_umur' => $request->umur,
		'pegawai_alamat' => $request->alamat
	]);
	// alihkan halaman ke halaman pegawai
	return redirect('/pegawai');

    }
    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('edit',['pegawai' => $pegawai]);

    }
    public function update(Request $request)
    {
        // update data pegawai
        DB::table('pegawai')->where('pegawai_id',$request->id)->update([
            'pegawai_nama' => $request->nama,
            'pegawai_jabatan' => $request->jabatan,
            'pegawai_umur' => $request->umur,
            'pegawai_alamat' => $request->alamat
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/pegawai');
    }
    public function hapus($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('pegawai')->where('pegawai_id',$id)->delete();

        // alihkan halaman ke halaman pegawai
        return redirect('/pegawai');
    }
    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;

    		// mengambil data dari table pegawai sesuai pencarian data
		$pegawai = DB::table('pegawai')
		->where('pegawai_nama','like',"%".$cari."%")
		->paginate();

    		// mengirim data pegawai ke view index
		return view('index',['pegawai' => $pegawai]);

	}
    public function view($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('view',['pegawai' => $pegawai]);

    }
}
