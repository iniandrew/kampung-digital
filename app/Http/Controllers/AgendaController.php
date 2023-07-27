<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class AgendaController extends Controller
{
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
        $titlePage = "Tambah Agenda";
        return view ('app.agenda.create', compact('titlePage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validation = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);

        $new = Agenda::create($request->all());

        Session::flash('success', 'Berhasil Menambah Agenda');
        return redirect()->route('agenda.index');
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
        $titlePage = "Edit Agenda";
        $navigation = "active";
        return view('app.agenda.edit', compact('agenda', 'titlePage', 'navigation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validation = $request->validate([
            'users_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);

        $agenda->update($request->all());

        Session::flash('success', 'Berhasil Mengedit Agenda');
        return redirect()->route('agenda.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        Session::flash('success', 'Berhasil Menghapus Agenda');
        return redirect()->route('agenda.index');
    }
}
