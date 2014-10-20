<?php

class controlController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($sensor,$value)
	{
        if($value <= 1 && $value >= 0) {
            Control::create([
                'sensors_id' => $sensor,
                'value' => $value,
                'status' => 1
            ]);
            return "OK";
        }
        else{
            return "Value can be 0/1";
        }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

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
	public function update()
	{
        $data = Control::join('sensors', 'sensors.id', '=', 'controls.sensors_id')->join('receptors', 'receptors.id', '=', 'sensors.receptors_id')->select('controls.id','receptors.mac', 'receptors.types_id', 'sensors.python_name', 'controls.value')->where('controls.status',1)->take(1)->get();
        if(count($data)>0){
            $data=$data[0];
            if($data->types_id<10){
                $data->types_id = "0".$data->types_id;
            }
            echo $data->mac.":".$data->types_id.":".$data->python_name.",".$data->value;
            $control = Control::find($data->id);
            $control->status = '0';
            $control->save();
        }
        else{
            echo 0;
        }
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
