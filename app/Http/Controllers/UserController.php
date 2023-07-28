<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;
use Validator;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();

            if (Auth::user()->role != "Super Admin") {
                abort(403, 'Anda tidak memiliki akses ke halaman ini');
            }

            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.user.index', [
            'titlePage' => 'Data Pengguna'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peoples = People::where('has_account', 0)->get();

        return view('app.user.create', [
            'titlePage' => "Tambah Pengguna",
            'peoples' => $peoples
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'unique' => 'email sudah digunakan'
        ];

        $validator = Validator::make($request->all(), [
            'people_id' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $people = People::find($request->people_id);

        $post = new User;

        $post->name = $people->name;
        $post->email = $request->email;
        $post->password = Hash::make($request->password);
        $post->role = $request->role;
        $post->people_id = $people->id;

        $post->save();

        //update status account
        $people->account = 1;

        $people->save();

        return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $peoples = People::where('account', 1)->get();

        return view('app.user.edit', [
            'titlePage' => "Edit Pengguna",
            'user' => $user,
            'peoples' => $peoples
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'unique' => 'email sudah digunakan'
        ];

        $validator = Validator::make($request->all(), [
            'people_id' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $people = People::find($request->people_id);

        $user = User::find($id);

        $user->name = $people->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->people_id = $people->id;

        $user->save();

        return redirect()->route('user.index')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // update acoount people
        $people = People::find($user->people_id);
        $people->account = 0;
        $people->save();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Berhasil menghapus data');
    }

    public function getData(Request $request){
        $users = User::where('id', '!=', Auth::user()->id)->get();

        if ($request->ajax()) {
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('actions', function($users) {
                    return view('app.user.action', compact('users'));
                })
                ->toJson();
        }
    }
}
