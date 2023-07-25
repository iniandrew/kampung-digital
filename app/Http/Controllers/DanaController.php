<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Session;

class DanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = "Pendanaan";
        $dataDana = Dana::all();
        $income = Dana::where('kategori', 'Pemasukan')->get();
        $inflow = 0;
        foreach ($income as $value) {
            $inflow += $value->total;
        }

        $spending = Dana::where('kategori', 'Pengeluaran')->get();
        $outlay = 0;
        foreach ($spending as $item) {
            $outlay += $item->total;
        }
        return view('app.dana.index', compact('titlePage', 'dataDana', 'inflow', 'outlay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titlePage = " Tambah Dana";
        return view('app.dana.create', compact('titlePage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bukti_nota' => 'required|image|mimes:jpg,png,jpeg|max:1000',
        ]);

        if($request->hasfile('bukti_nota'))
        {
            $file = $request->file('bukti_nota');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/dana/', $filename);
        }

        $post = new Dana;

        $post->users_id = Auth::user()->id;
        $post->kategori = $request->kategori;
        $post->rincian = $request->rincian;
        $post->bukti_nota = $filename;
        $post->tanggal_transaksi = $request->tanggal_transaksi;
        $total = preg_replace("/[^a-zA-Z0-9]/", "", $request->total);
        $post->total = $total;

        $post->save();

        Session::flash('success', 'Berhasil Menambah Dana');
        return redirect()->route('dana.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function show(Dana $dana)
    {
        $titlePage = "Detail Dana";
        return view('app.dana.detail', compact('dana', 'titlePage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function edit(Dana $dana)
    {
        $titlePage = "Edit Dana";
        $navigation = "active";
        return view('app.dana.edit', compact('dana', 'titlePage', 'navigation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dana $dana)
    {
        $validatedData = $request->validate([
            'bukti_nota' => 'nullable|image|mimes:jpg,png,jpeg|max:1000',
        ]);

        $oldFile = Dana::where('id', $dana->id)->value('bukti_nota');

        $update = Dana::where('id', $dana->id)->firstOrFail();

        $update->users_id = Auth::user()->id;
        $update->kategori = $request->kategori;
        $update->rincian = $request->rincian;
        $update->tanggal_transaksi = $request->tanggal_transaksi;
        $total = preg_replace("/[^a-zA-Z0-9]/", "", $request->total);
        $update->total = $total;

        if($request->hasfile('bukti_nota'))
        {
            $file = $request->file('bukti_nota');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/dana/', $filename);
            $destroy = public_path().'\\storage\\dana\\'. $oldFile;
            unlink($destroy);

            $update->bukti_nota = $filename;
        }

        $update->save();
        Session::flash('success', 'Berhasil Mengedit Dana');
        return redirect()->route('dana.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dana $dana)
    {
        File::delete('storage/dana/'. $dana->bukti_nota);
        $dana->delete();

        Session::flash('success', 'Berhasil Menghapus Dana');
        return redirect()->route('dana.index');
    }
}
