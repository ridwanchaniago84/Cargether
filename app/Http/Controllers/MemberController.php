<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return view('members.index', [
            'no'            => 1,
            'members'   => $members,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'name'        => 'required|max:100|regex:/^[A-Za-z ]*$/',
            'email'             => 'required|email|unique:users',
            'phone'             => 'required|regex:/^[0-9]*$/|max:20',
            'age'               => 'required|max:3',
            'address'           => 'required|max:300',
            'gender'            => 'required|max:1|regex:/^[LP]*$/',
            'ktp'               => 'required|image|max:5120',
            'sim'               => 'required|image|max:5120',
        ])->validate();

        $members = Member::create([
            'name'          => $request->get('member_name'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'age'           => $request->get('age'),
            'address'       => $request->get('address'),
            'gender'        => $request->get('gender'),
            'ktp'           => $path,
            'sim'           => $path,
            
        ]);

        return redirect()->route('members.index')->with('success', 'Berhasil menambahkan Member baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $members = Member::with('user')->findOrFail($id);

        return view('members.show', [
            'member' => $members,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members = Member::with('user')->findOrFail($id);

        return view('members.edit', [
            'member' => $members,
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
        $validation = \Validator::make($request->all(), [
            'name'        => 'required|max:100|regex:/^[A-Za-z ]*$/',
            'email'             => 'required|email|unique:users',
            'phone'             => 'required|regex:/^[0-9]*$/|max:20',
            'age'               => 'required|max:3',
            'address'           => 'required|max:300',
            'gender'            => 'required|max:1|regex:/^[LP]*$/',
            'ktp'               => 'required|image|max:5120',
            'sim'               => 'required|image|max:5120',
            'status_option'     => 'required|boolean',
        ])->validate();

        $members = Member::whereId($id)->update([
            'name'          => $request->get('member_name'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'age'           => $request->get('age'),
            'address'       => $request->get('address'),
            'gender'        => $request->get('gender'),
            'ktp'           => $path,
            'sim'           => $path,
            'is_active'     => $request->get('status_option'),
            
        ]);

        return redirect()->route('members.index')->with('success', 'Berhasil mengupdate Member baru!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $commodity = Commodity::findOrFail($id);
            $commodity->delete();

            return redirect()->route('members.index')->with('success', 'Berhasil Menghapus Member ' . $commodity->name . '!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('members.index')->with('danger','Member gagal dihapus. Code: SQLSTATE['.$err->getCode().']');
        }
    }
}
