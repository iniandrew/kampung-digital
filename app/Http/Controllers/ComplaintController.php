<?php

namespace App\Http\Controllers;

use App\Actions\ComplaintAction;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::query()->get();

        return view('app.complaint.index', [
            'titlePage' => 'Aduan',
            'complaints' => $complaints,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.complaint.create', [
            'titlePage' => 'Buat Aduan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $command = (new ComplaintAction($request))->create();

        return $command
            ? redirect()->route('complaint.index')->with('success', 'Aduan berhasil dibuat')
            : redirect()->back()->with('error', 'Aduan gagal dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
