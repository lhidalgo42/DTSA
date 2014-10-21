<?php

class SensorsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if (Auth::check()) {
            $values = Value::where('sensors_id',$id)->take(100)->orderBy('id', 'desc')->get();
            /*
            $highchart = array('chart' =>
                array('type' => 'spline'),
                'title' => array('text' => 'Grafico de Temperaturas del dia'),
                'subtitle' => array('text' => 'subtitulo'),
                'xAxis' => array( 'type' => 'datetime',
                    'dateTimeLabelFormats' => array(
                        'month' => '%e. %b',
                        'year' => '%b'),
                    'title' => array('text' => 'Date')),
                'yAxis' => array('title' => array('text' => 'Snow depth (m)'),
                    'min' => 0),
                'tooltip' => array('headerFormat' => '<b>{series.name}</b><br>','pointFormat' => '{point.x:%e. %b}: {point.y:.2f} m'),
                'series' => array('name' => 'winter 2009-2010'),
                'data' => array('','')); */
            return View::make('sensors.index',compact('values'));
        }
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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
