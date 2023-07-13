<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\PeopleAction;
use App\Models\People;
use Validator;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peoples = People::all();

        return view('app.people.index', [
            'titlePage' => 'Data Warga',
            'peoples' => $peoples
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.people.create', ['titlePage' => 'Tambah Data Warga']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeopleAction $action)
    {
        $command = $action->create();

        return $command
            ? redirect()->route('people.index')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $people = People::find($id);

        return view('app.people.show', [
            'titlePage' => 'Detail Data Warga',
            'people' => $people
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $people = People::find($id);

        return view('app.people.edit', [
            'titlePage' => 'Edit Data Warga',
            'people' => $people
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeopleAction $action, $id)
    {
        $people = People::find($id);
        $command = $action->update($people);

        return $command
            ? redirect()->route('people.index')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getData(Request $request){
        $peoples = People::all();

        if ($request->ajax()) {
            return datatables()->of($peoples)
                ->addIndexColumn()
                ->addColumn('actions', function($peoples) {
                    return view('app.people.action', compact('peoples'));
                })
                ->toJson();
        }
    }
}
