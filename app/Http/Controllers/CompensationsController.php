<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compensation;
use App\Models\Transaction;
use App\Models\CompenCategory;
use Illuminate\Support\Facades\Auth;

class CompensationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner|staff|treasurer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compensations = Compensation::join('transactions', 'transactions.id', 'compensations.transaction_id')
            ->join('compen_categories', 'compen_categories.id', 'compensations.compen_category_id')
            ->join('members', 'members.id', 'transactions.member_id')
            ->join('vehicles', 'vehicles.id', 'transactions.vehicle_id')
            ->select([
                'compensations.*',
                'vehicles.plate_no',
                'members.name',
                'compen_categories.complaint',
                'compen_categories.price',
            ])
            ->get();

        return view('Compensations.index', [
            'no'            => 1,
            'compensations' => $compensations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('staff')) {
            $transactions = Transaction::join('vehicles', 'vehicles.id', 'transactions.vehicle_id')
                ->join('members', 'members.id', 'transactions.member_id')
                ->select([
                    'transactions.*',
                    'vehicles.plate_no',
                    'members.name'
                ])
                ->get();

            $compenCategories = CompenCategory::all();

            return view('Compensations.create', [
                'transactions' => $transactions,
                'compenCategories' => $compenCategories
            ]);
        }

        return abort(403, 'Unauthorized action.');
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
            'transaction_id' => 'required|integer',
            'compen_category_id' => 'required|integer'
        ])->validate();

        $transaction = Compensation::create([
            'transaction_id' => $request->get('transaction_id'),
            'compen_category_id' => $request->get('compen_category_id')
        ]);

        return redirect()->route('compensations.index')->with('success', 'Berhasil menambahkan kompensasi baru!');
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
        if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('staff')) {
            $compensation = Compensation::findOrFail($id);
            $transactions = Transaction::join('vehicles', 'vehicles.id', 'transactions.vehicle_id')
                ->join('members', 'members.id', 'transactions.member_id')
                ->select([
                    'transactions.*',
                    'vehicles.plate_no',
                    'members.name'
                ])
                ->get();

            $compenCategories = CompenCategory::all();

            return view('Compensations.edit', [
                'transactions' => $transactions,
                'compenCategories' => $compenCategories,
                'compensation' => $compensation
            ]);
        }

        return abort(403, 'Unauthorized action.');
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
            'transaction_id' => 'required|integer',
            'compen_category_id' => 'required|integer'
        ])->validate();

        $transaction = Compensation::whereId($id)->update([
            'transaction_id' => $request->get('transaction_id'),
            'compen_category_id' => $request->get('compen_category_id')
        ]);

        return redirect()->route('compensations.index')->with('success', 'Berhasil mengubah kompensasi!');
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
            $compensation = Compensation::findOrFail($id);
            $compensation->delete();

            return redirect()->route('compensations.index')->with('success', 'Berhasil Menghapus Kompensasi!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('compensations.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
