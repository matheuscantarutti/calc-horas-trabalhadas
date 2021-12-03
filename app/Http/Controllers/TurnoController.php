<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTurnoRequest;
use Illuminate\Http\Response;
use App\Actions\TurnoAction;
use DateTime;
use App\Models\Turno;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        return view("horas");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return view('horas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTurnoRequest $request
     * @return Response
     */
    public function store(StoreTurnoRequest $request)
    {
        $turno_info = TurnoAction::calculaHorasTrabalhadas(
            new DateTime($request->data_hora_inicial),
            new DateTime($request->data_hora_final)
        );

        $turno_data = [...$turno_info, ...$request->all()];

        $turno = new Turno($turno_data);

        $turno->save();

        return redirect()->route("resultado")->with('data', $turno_info);
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
