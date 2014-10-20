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
            if(count($data) == count($sensors_ids))
            {
                for( $i=0;$i<count($data);$i++)
                {
                    Value::create(['value' => $data[$i], 'sensors_id' => $sensors_ids[$i] ]);
                }
            }
            else
            {
                die("Numero de elementos incorrecto");
            }
        }
        if($type == 2)
        {

            for($i=0 ; $i<count($data);$i++)
            {
                $data[$i] = hexdec($data[$i]);
            }
            $length  = count($data)/3;
            if(count($sensors) == $length)
            {
                $valors = [];
                if($data[2]<10){
                    $data[2] = "0".$data[2];
                }
                if($data[5]<10){
                $data[5] = "0".$data[5];
                }

                if($data[0] == 0){
                    $valors[] = $data[1].".".$data[2];
                }
                else{
                    $valors[] = "-".$data[1].".".$data[2];
                }

                if($data[3] == 0){
                    $valors[] = $data[4].".".$data[5];
                }
                else{
                    $valors[] = "-".$data[4].".".$data[5];
                }
                for ($i=0 ; $i < count($valors);$i++){
                    Value::create(['value' => $valors[$i], 'sensors_id' => $sensors_ids[$i] ]);
                }
            }
            else
            {
                die("Numero de elementos incorrecto");
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
