<?php

namespace App\Http\Controllers;

use App\Actions\ComplaintAction;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Agenda;
use App\Models\Fund;
use App\Models\Complaint;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $peoples = People::all()->count();
        $schedules = Agenda::orderBy('created_at', 'desc')->limit(5)->get();
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

        $totalFund = $inflow - $outlay;

        $complaints = (new ComplaintAction())->getLatestComplaints();

        $countComplaints = Complaint::where('status', 'in_progress')->orWhere('status', 'closed')->count();

        return view('app.home', [
            'villages' => $peoples,
            'schedules' => $schedules,
            'fund' => $totalFund,
            'complaints' => $complaints,
            'totalComplaints' => $countComplaints
        ]);
    }

    public function changePassword(){
        return view('app.account.change_password', [
            'titlePage' => 'Ubah Password'
        ]);
    }
}
