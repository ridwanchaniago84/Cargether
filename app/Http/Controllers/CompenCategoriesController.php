<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompenCategory;

class CompenCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CompenCategorys = CompenCategory::all();

        return view('CompenCategories.index', [
            'no' => 1,
            'CompenCategorys' => $CompenCategorys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CompenCategories.create');
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
            'complaint' => 'required',
            'price' => 'required|integer'
        ])->validate();

        $compenCategory = CompenCategory::create([
            'complaint' => $request->get('complaint'),
            'price' => $request->get('price')
        ]);

        return redirect()->route('compencategories.index')->with('success', 'Berhasil menambahkan Complaint Category baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compenCategory = CompenCategory::findOrFail($id);

        return view('CompenCategories.edit', [
            'compenCategory' => $compenCategory,
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
            'complaint' => 'required',
            'price' => 'required|integer'
        ])->validate();

        $compenCategory = CompenCategory::whereId($id)->update([
            'complaint' => $request->get('complaint'),
            'price' => $request->get('price')
        ]);

        return redirect()->route('compencategories.index')->with('success', 'Berhasil mengubah Complaint Category!');
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
            $compenCategory = CompenCategory::findOrFail($id);
            $compenCategory->delete();

            return redirect()->route('compencategories.index')->with('success', 'Berhasil Menghapus Complaint Category!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('compencategories.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
