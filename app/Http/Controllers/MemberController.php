<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

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

    public function uploadFile($file, $type)
    {
        $extension  = $file->getClientOriginalExtension();
        $randomINT = random_int(1, 9999);
        $fileName  = date("hisaYmd") . $randomINT . '.' . $extension;
        $destination = base_path('public/assets/uploads/' . $type);
        $file->move($destination, $fileName);

        return $fileName;
    }

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

        $ktp = $this->uploadFile($request->file('ktp'), 'ktp');
        $sim = $this->uploadFile($request->file('sim'), 'sim');

        $members = Member::create([
            'name'          => $request->get('name'),
            'email'         => $request->get('email'),
            'phone_no'         => $request->get('phone'),
            'age'           => $request->get('age'),
            'address'       => $request->get('address'),
            'gender'        => $request->get('gender'),
            'ktp'           => $ktp,
            'sim'           => $sim
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
        $members = Member::findOrFail($id);

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
            'ktp'               => 'image|max:5120',
            'sim'               => 'image|max:5120',
            'status_option'     => 'required|boolean',
        ])->validate();

        $dataMember = Member::where('id', $id)->first();

        $fileKTP = $request->file('ktp');
        $fileSIM = $request->file('sim');
        $ktp = $dataMember->ktp;
        $sim = $dataMember->sim;

        if ($fileKTP != null && $fileKTP != '')
        {
            $ktp = $this->uploadFile($fileKTP, 'ktp');
        }

        if ($fileSIM != null && $fileSIM != '')
        {
            $sim = $this->uploadFile($fileSIM, 'sim');
        }

        $members = Member::whereId($id)->update([
            'name'          => $request->get('name'),
            'email'         => $request->get('email'),
            'phone_no'      => $request->get('phone'),
            'age'           => $request->get('age'),
            'address'       => $request->get('address'),
            'gender'        => $request->get('gender'),
            'ktp'           => $ktp,
            'sim'           => $sim,
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
            $commodity = Member::findOrFail($id);
            $commodity->delete();

            return redirect()->route('members.index')->with('success', 'Berhasil Menghapus Member ' . $commodity->name . '!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('members.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
