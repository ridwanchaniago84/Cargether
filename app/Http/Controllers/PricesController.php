<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();

        return view('prices.index', [
            'no'            => 1,
            'prices'   => $prices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prices.create');
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
            'type' => 'required|max:100|regex:/^[A-Za-z ]*$/',
            'price' => 'required|integer'
        ])->validate();

        $price = Price::create([
            'type' => $request->get('type'),
            'price' => $request->get('price'),
        ]);

        return redirect()->route('prices.index')->with('success', 'Berhasil menambahkan harga baru!');
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
        $prices = Price::findOrFail($id);

        return view('prices.edit', [
            'price' => $prices,
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
            'type' => 'required|max:100|regex:/^[A-Za-z ]*$/',
            'price' => 'required|integer'
        ])->validate();

        $members = Price::whereId($id)->update([
            'type' => $request->get('type'),
            'price' => $request->get('price'),
        ]);

        return redirect()->route('prices.index')->with('success', 'Berhasil mengubah harga!');
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
            $price = Price::findOrFail($id);
            $price->delete();

            return redirect()->route('prices.index')->with('success', 'Berhasil Menghapus harga!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('prices.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
