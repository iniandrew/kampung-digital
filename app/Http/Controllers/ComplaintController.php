<?php

namespace App\Http\Controllers;

use App\Actions\ComplaintAction;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ComplaintAction $action)
    {
        if (auth()->user()->role === User::ROLE_WARGA) {
            $complaints = $action->getComplaintByReporter();
        } else {
            $complaints = $action->getAllComplaints();
        }

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
        return view('app.complaint.show', [
            'titlePage' => 'Detail Aduan',
            'complaint' => $complaint,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        return view('app.complaint.edit', [
            'titlePage' => 'Ubah Aduan',
            'complaint' => $complaint,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $command = (new ComplaintAction($request))->edit($complaint);

        return $command
            ? redirect()->route('complaint.index')->with('success', 'Aduan berhasil diubah')
            : redirect()->back()->with('error', 'Aduan gagal diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }

    public function review(Complaint $complaint)
    {
        return view('app.complaint.review', [
            'titlePage' => 'Review Aduan',
            'complaint' => $complaint,
        ]);
    }

    public function reviewAction(Request $request, Complaint $complaint): \Illuminate\Http\RedirectResponse
    {
        $command = (new ComplaintAction($request))->review($complaint);

        return $command
            ? redirect()->route('complaint.index')->with('success', 'Aduan berhasil direview')
            : redirect()->back()->with('error', 'Aduan gagal direview');
    }

    public function respond(Request $request, Complaint $complaint): \Illuminate\Http\RedirectResponse
    {
        $command = (new ComplaintAction($request))->respond($complaint);

        return $command
            ? redirect()->route('complaint.index')->with('success', 'Aduan berhasil ditanggapi')
            : redirect()->back()->with('error', 'Aduan gagal ditanggapi');
    }
}
