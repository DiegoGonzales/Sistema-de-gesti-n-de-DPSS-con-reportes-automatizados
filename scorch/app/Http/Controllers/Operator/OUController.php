<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\OU;
use Illuminate\Http\Request;


class OUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.ou.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allOU = OU::pluck('name', 'id');
        //->where('level','<','3');
        return view('operator.ou.create', compact('allOU'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ruc' => 'nullable',
            'level' => 'required',
            'master_ou' => 'nullable',
            'status' => 'required',
        ]);

        $ou = OU::create($request->all());

        return redirect()->route('operator.ous.edit', $ou);
    }

    /*
    public function storeOperation(Request $request)
    {
        switch ($request->query('action')) {
            case 'save':
                // Save model
                $operation = new Operation($request->all());
                dd($operation);
                break;
        }
    }*/

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



    public function edit(OU $ou)
    {
        $allOU = OU::pluck('name', 'id');
        return view('operator.ou.edit', compact('ou', 'allOU'));
    }


    public function update(Request $request, OU $ou)
    {


        $request->validate([
            'name' => 'required',
            'ruc' => 'nullable',
            'level' => 'required',
            'master_ou' => 'nullable',
            'status' => 'required',
        ]);

        $ou->update($request->all());
        return redirect()->route('operator.ous.edit', $ou);
    }



    public function destroy($id)
    {
        //
    }
}
