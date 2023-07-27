<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgendaController extends Controller
{
    public function guard(){
        if (Auth::user()->role != "Super Admin") {
           abort(403, 'Anda tidak memiliki akses ke halaman ini');
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titlePage = "Agenda";
        if (Auth::user()->role == 'Admin') {
            $dataAgenda = Agenda::all();
        } else {
            $dataAgenda = Agenda::where('status', '!=', 'arsip')->get();
        }

        return view('app.agenda.index', compact('titlePage', 'dataAgenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->guard();
        $titlePage = "Tambah Agenda";
        return view ('app.agenda.create', compact('titlePage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->guard();
        $messages = [
            'required' => 'Kolom harus diisi.'
        ];

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ], $messages);

        $agenda = new Agenda;

        $agenda->user_id = Auth::user()->id;
        $agenda->title = $request->title;
        $agenda->content = $request->content;
        $agenda->venue = $request->venue;
        $agenda->start_date = $request->start_date;
        $agenda->end_date = $request->end_date;
        $agenda->start_time = $request->start_time;
        $agenda->end_time = $request->end_time;
        $agenda->status = $request->status;

        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Berhasil menambahkan data agenda');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        $titlePage = "Edit Agenda";
        return view('app.agenda.detail', compact('agenda', 'titlePage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        $this->guard();
        $titlePage = "Edit Agenda";
        $navigation = "active";
        return view('app.agenda.edit', compact('agenda', 'titlePage', 'navigation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $this->guard();
        $messages = [
            'required' => 'Kolom harus diisi.'
        ];

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ], $messages);

        $agenda->user_id = Auth::user()->id;
        $agenda->title = $request->title;
        $agenda->content = $request->content;
        $agenda->venue = $request->venue;
        $agenda->start_date = $request->start_date;
        $agenda->end_date = $request->end_date;
        $agenda->start_time = $request->start_time;
        $agenda->end_time = $request->end_time;
        $agenda->status = $request->status;

        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Berhasil mengubah data agenda');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $this->guard();
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Berhasil mengubah data agenda');
    }
}
