<?php

class ValueController extends \BaseController {

	public function create($mac,$type,$data)
	{
        $receptor = Receptor::where('mac', $mac)->get();
        $sensors = Sensor::where('receptors_id',$receptor[0]->id)->get();

            $sensors_ids = [];
            for($i=0 ; $i < count($sensors) ; $i++ )
            {
                array_push($sensors_ids,$sensors[$i]->id);

            }
            $data=explode(":",$data);
        if($type == 1) {

            for($i=0 ; $i<count($data);$i++)
            {
                $data[$i] = hexdec($data[$i]);
            }
                $valors = [];
                if($data[2]<10) {
                    $data[2] = "0" . $data[2];
                }

                if($data[0] == 0){
                    $valors[] = $data[1].".".$data[2];
                }
                else{
                    $valors[] = "-".$data[1].".".$data[2];
                }
                for ($i=0 ; $i < count($valors);$i++){
                    $value = new Value;
                    $value->value = $valors[$i];
                    $value->$sensors_ids[$i];
                    $value->save();
                    echo $value->id;
                }
        }
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show()
	{

	}
}
