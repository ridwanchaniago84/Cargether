<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Price;

class VechiclesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner|staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::join('prices', 'prices.id', 'vehicles.price_id')
            ->select([
                'vehicles.*',
                'prices.price'
            ])
            ->get();

        return view('Vechicles.index', [
            'no'            => 1,
            'vehicles'   => $vehicles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prices = Price::all();
        return view('vechicles.create', ['prices' => $prices]);
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
            'plate_no'        => 'required|max:100|unique:vehicles,plate_no',
            'brand'           => 'required',
            'brand_type'      => 'required',
            'id_price'        => 'required|integer',
            'is_active'       => 'required|boolean'
        ])->validate();

        $vehicle = Vehicle::create([
            'plate_no'          => $request->get('plate_no'),
            'brand'         => $request->get('brand'),
            'brand_type'         => $request->get('brand_type'),
            'price_id'           => $request->get('id_price'),
            'is_active'       => $request->get('is_active')
        ]);

        return redirect()->route('vechicles.index')->with('success', 'Berhasil menambahkan Kendaraan baru!');
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
        $vehicle = Vehicle::findOrFail($id);
        $prices = Price::all();

        return view('vechicles.edit', [
            'vehicle' => $vehicle,
            'prices' => $prices
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
            'plate_no'        => 'required|max:100|unique:vehicles,plate_no,' . $id,
            'brand'           => 'required',
            'brand_type'      => 'required',
            'id_price'        => 'required|integer',
            'is_active'       => 'required|boolean'
        ])->validate();

        $vehicle = Vehicle::whereId($id)->update([
            'plate_no'          => $request->get('plate_no'),
            'brand'         => $request->get('brand'),
            'brand_type'         => $request->get('brand_type'),
            'price_id'           => $request->get('id_price'),
            'is_active'       => $request->get('is_active')
        ]);

        return redirect()->route('vechicles.index')->with('success', 'Berhasil mengubah data kendaraan!');
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
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();

            return redirect()->route('vechicles.index')->with('success', 'Berhasil Menghapus Data Kendaraan!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('vechicles.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
