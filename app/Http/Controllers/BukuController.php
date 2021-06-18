<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Buku;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Alert;
use PDF;

class BukuController extends Controller
{

    public function index(Request $request, Builder $builder)
    {
        if($request->ajax()){
            $buku = Buku::all();
            return DataTables::of($buku)
            ->editColumn('action', function($buku){
                return view('partials._action', [
                    'model'     => $buku,
                    'form_url'  => route('buku.destroy', $buku->id),
                    'edit_url'  => route('buku.edit', $buku->id),
                    'confirm_message' => 'Yakin Mau Menghapus Data Ini ?'

                ]);
            })
            ->editColumn('judul', function ($buku){
                return view('partials._detail', [
                    'model'         => $buku,
                    'detail_url'   => route('buku.show', $buku->id)
                ]);
            })
            ->rawColumns(['action', 'judul'])
            ->make(true);
        }

        $html = $builder->columns([
            ['data'  => 'judul', 'name' => 'judul', 'title' => 'Judul Buku'],
            ['data'  => 'isbn', 'name' => 'isbn', 'title' => 'ISBN'],
            ['data'  => 'penerbit', 'name' => 'penerbit', 'title' => 'Penerbit'],
            ['data'  => 'tahun_terbit', 'name' => 'tahun_terbit', 'title' => 'Tahun Terbit'],
            ['data'  => 'jumlah', 'name' => 'jumlah', 'title' => 'Jumlah'],
            ['data'  => 'deskripsi', 'name' => 'deskripsi', 'title' => 'Deskripsi'],
            ['data'  => 'lokasi', 'name' => 'lokasi', 'title' => 'Lokasi'],
            ['data'  => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false],
        ]);

        return view('buku.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'judul'     => 'required',
            'isbn'      => 'required|numeric',
            'cover'     => 'required|mimes:jpg,jpeg,png|max:1024'
        ],
        [
            'isbn.required'     => 'Nomor ISBN Harus Di Isi',
            'isbn.numeric'      => 'Nomor Harus Integer Bukan String',
            'cover.required'    => 'File Cover Harus di isi',
            'cover.mimes'       => 'File Cover Harus Bertipe .png .jpg dan jpeg',
            'cover.max'         => 'Maksimal File 1MB'
        ]
    );

        $namaCover = NULL;

        if($request->hasFile('cover')){
            $fileUpload     = $request->file('cover');
            $extension      = $fileUpload->getClientOriginalExtension();
            $namaCover      = md5(time()).'.'.$extension;
            $destination    = public_path().DIRECTORY_SEPARATOR.'cover';
            $fileUpload->move($destination, $namaCover);

        }
        $buku = Buku::create([
            'judul'         => $request->judul,
            'isbn'          => $request->isbn,
            'penerbit'      => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'jumlah'        => $request->jumlah,
            'deskripsi'     => $request->deskripsi,
            'lokasi'        => $request->lokasi,
            'cover'        => $namaCover

        ]);

        toast('Berhasil Menambahkan Buku Baru', 'info');
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $this->validate($request,
        [
            'judul'     => 'required',
            'isbn'      => 'required|numeric',
            'cover'     => 'nullable|mimes:jpg,jpeg,png|max:1024'
        ],
        [
            'isbn.required'     => 'Nomor ISBN Harus Di Isi',
            'isbn.numeric'      => 'Nomor Harus Integer Bukan String',
            'cover.required'    => 'File Cover Harus di isi',
            'cover.mimes'       => 'File Cover Harus Bertipe .png .jpg dan jpeg',
            'cover.max'         => 'Maksimal File 1MB'
        ]
    );

        $namaCover = $buku->cover;

        if($request->hasFile('cover')){
            $fileUpload     = $request->file('cover');
            $extension      = $fileUpload->getClientOriginalExtension();
            $namaCover      = md5(time()).'.'.$extension;
            $destination    = public_path().DIRECTORY_SEPARATOR.'cover';

            if($buku->cover !== '')
            {
                $gambarLama = $buku->cover;
                $filePath   = public_path().DIRECTORY_SEPARATOR.'cover'.DIRECTORY_SEPARATOR. $gambarLama;
                try{
                    File::delete($filePath);
                }catch(FileNotFoundException $e)
                {
                    dd($e);
                }
            }
            $fileUpload->move($destination, $namaCover);

        }
        $buku->update([
            'judul'         => $request->judul,
            'isbn'          => $request->isbn,
            'penerbit'      => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'jumlah'        => $request->jumlah,
            'deskripsi'     => $request->deskripsi,
            'lokasi'        => $request->lokasi,
            'cover'         => $namaCover

        ]);

        toast('Berhasil Menambahkan Buku Baru', 'info');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        if($buku->cover !== '')
        {
                $gambarLama = $buku->cover;
                $filePath   = public_path().DIRECTORY_SEPARATOR.'cover'.DIRECTORY_SEPARATOR. $gambarLama;
                try{
                    File::delete($filePath);
                } catch(FileNotFoundException $e){
                    dd($e);
                }
            }
        $buku->destroy($buku->id);
        Alert::success('Berhasil', 'Hapus Sukses');
        return redirect()->route('buku.index');
    }

    public function cetakBuku()
    {
        $buku = Buku::all();
        $pdf = PDF::loadView('buku.cetak', compact('buku'))->setPaper('A4', 'landscape');
        return $pdf->stream('cetak buku.pdf');
    }
}
