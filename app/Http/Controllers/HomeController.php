<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Agenda;

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
        return view('app.home', [
            'villages' => $peoples,
            'schedules' => $schedules
        ]);
    }

    public function changePassword(){
        return view('app.account.change_password', [
            'titlePage' => 'Ubah Password'
        ]);
    }
}
