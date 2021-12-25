<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spending;
use PDF;

class SpendingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner')->only('index', 'create', 'edit');
        $this->middleware('role:owner|treasurer')->only('index', 'create');
    }

    public function print()
    {
        $spendings = Spending::all();
        $pdf = PDF::loadView('Spendings.Print', [
            'spendings' => $spendings,
            'no' => 1
        ])
            ->setPaper('a4', 'portrait');

        return $pdf->download('Data Pengeluaran.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spendings = Spending::all();

        return view('Spendings.index', [
            'no' => 1,
            'spendings' => $spendings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Spendings.create');
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
            'name' => 'required',
            'price' => 'required|integer',
            'date' => 'required|date',
        ])->validate();

        $spending = Spending::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'date' => $request->get('date')
        ]);

        return redirect()->route('spendings.index')->with('success', 'Berhasil menambahkan pengeluaran!');
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
        $spending = Spending::findOrFail($id);

        return view('Spendings.edit', [
            'spending' => $spending,
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
            'name' => 'required',
            'price' => 'required|integer',
            'date' => 'required|date',
        ])->validate();

        $spending = Spending::whereId($id)->update([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'date' => $request->get('date')
        ]);

        return redirect()->route('spendings.index')->with('success', 'Berhasil mengubah pengeluaran!');
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
            $spending = Spending::findOrFail($id);
            $spending->delete();

            return redirect()->route('spendings.index')->with('success', 'Berhasil Menghapus pengeluaran!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('spendings.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
