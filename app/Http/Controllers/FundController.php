<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;
use Validator;
use Auth;
use File;
use PDF;

class FundController extends Controller
{
    public function guard(){
        if (Auth::user()->role != "Bendahara") {
           abort(403, 'Anda tidak memiliki akses ke halaman ini');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titlePage = "Pendanaan";
        $dataDana = Fund::all();
        $income = Fund::where('category', 'Pemasukan')->get();
        $inflow = 0;
        foreach ($income as $value) {
            $inflow += $value->amount;
        }

        $spending = Fund::where('category', 'Pengeluaran')->get();
        $outlay = 0;
        foreach ($spending as $item) {
            $outlay += $item->amount;
        }
        return view('app.fund.index', compact('titlePage', 'dataDana', 'inflow', 'outlay'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->guard();
        $titlePage = "Tambah Dana";
        return view('app.fund.create', compact('titlePage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->guard();
        $messages = [
            'required' => 'Kolom harus diisi.',
            'mimes' => "File harus berupa JPG, JPEG, atau PNG",
            'file' => "Harap Upload file"
        ];

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'body' => 'required',
            'amount' => 'required',
            'transaction_date' => 'required',
            'attachment' => 'file|mimes:png,jpg,jpeg|required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('attachment');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('storage/dana/', $filename);

        $post = new Fund;

        $post->user_id = Auth::user()->id;
        $post->category = $request->category;
        $post->body = $request->body;
        $total = preg_replace("/[^a-zA-Z0-9]/", "", $request->amount);
        $post->amount = $total;
        $post->transaction_date = $request->transaction_date;
        $post->attachment = $filename;

        $post->save();

        return redirect()->route('fund.index')->with('success', "Berhasil menambahkan data dana");
    }

    /**
     * Display the specified resource.
     */
    public function show(Fund $fund)
    {
        $titlePage = " Detail Dana";
        return view('app.fund.show', [
            'titlePage' => $titlePage,
            'dana' => $fund
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fund $fund)
    {
        $this->guard();
        $titlePage = " Edit Dana";
        return view('app.fund.edit', [
            'titlePage' => $titlePage,
            'dana' => $fund
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {
        $this->guard();
        $messages = [
            'required' => 'Kolom harus diisi.',
            'mimes' => "File harus berupa JPG, JPEG, atau PNG",
            'file' => "Harap Upload file"
        ];

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'body' => 'required',
            'amount' => 'required',
            'transaction_date' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasfile('attaachment'))
        {
            $validateFile = Validator::make($request->all(), [
                'attachment' => 'file|mimes:png,jpg,jpeg'
            ], $messages);

            if ($validateFile->fails()) {
                return redirect()->back()->withErrors($validateFile)->withInput();
            }

            $file = $request->file('attaachment');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/dana/', $filename);
            $destroy = public_path().'\\storage\\dana\\'. $fund->attaachment;
            unlink($destroy);

            $fund->attaachment = $filename;
        }

        $fund->category = $request->category;
        $fund->body = $request->body;
        $total = preg_replace("/[^a-zA-Z0-9]/", "", $request->amount);
        $fund->amount = $total;
        $fund->transaction_date = $request->transaction_date;

        $fund->save();
        return redirect()->route('fund.index')->with('success', "Berhasil mengupdate data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fund $fund)
    {
        $this->guard();
        File::delete('storage/dana/'. $fund->attachment);
        $fund->delete();

        return redirect()->route('fund.index')->with('success', 'Berhasil menghapus dana');
    }

    public function export(){
        $this->guard();
        $funds = Fund::all();
        $income = Fund::where('category', 'Pemasukan')->get();
        $inflow = 0;
        foreach ($income as $value) {
            $inflow += $value->amount;
        }

        $spending = Fund::where('category', 'Pengeluaran')->get();
        $outlay = 0;
        foreach ($spending as $item) {
            $outlay += $item->amount;
        }

        $pdf = PDF::loadView('app.fund.export', compact('funds', 'inflow', 'outlay'));
        return $pdf->download('Pendanaan.pdf');
    }
}
