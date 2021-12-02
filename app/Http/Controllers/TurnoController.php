<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTurnoRequest;
use Illuminate\Http\Response;
use DateTime;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTurnoRequest $request
     * @return Response
     */
    public function store(StoreTurnoRequest $request)
    {
        dd($request->input()['data_hora_inicial']);
        $hora_inicial = new DateTime($request->input()['data_hora_inicial']);
        $hora_final = new DateTime($request->input()['data_hora_final']);
        $limite_diurno = new DateTime("0000-00-00 22:00:00");
        $limite_noturno = new DateTime("0000-00-00 05:00:00");
        $total_diurno = "00:00:00";
        $total_noturno = "00:00:00";

        dd($hora_inicial);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
