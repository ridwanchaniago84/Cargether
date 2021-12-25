<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::role(['owner', 'treasurer', 'staff'])->get();
        
        $authorizedRoles = ['owner', 'treasurer', 'staff'];
        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
            return $query->whereIn('name', $authorizedRoles);
        })->get();
        
        return view('users.index', [
            'no'    => 1,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'name'          => 'required|max:100|regex:/^[A-Za-z ]*$/',
            'email'         => 'required|email|unique:users',
            'role'          => 'required',
        ])->validate();

        $user = User::create([
            'name'          => ucwords($request->get('name')),
            'email'         => $request->get('email'),
            'password'      => bcrypt('c4rg3ther'),
        ]);
        $user->assignRole($request->get('role'));

        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan Administrator baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', [
            'user'  => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->id != $id) {
            $validation = \Validator::make($request->all(), [
                'role'     => 'required',
            ])->validate();

            $user = User::findOrFail($id);
            $user->syncRoles($request->get('role'));

            return redirect()->route('users.index')->with('success', 'Berhasil mengubah role dari ' . $user->name . '!');
        }

        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->id != $id) {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Berhasil menghapus Administrator ' . $user->name . '!');
        }

        return abort(403);
    }
}
