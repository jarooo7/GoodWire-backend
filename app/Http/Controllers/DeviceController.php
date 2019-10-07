<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;


class DeviceController extends Controller
{
    public function index(){
        return Device::all();
    }

    public function show_survey($key){
        $device = Device::findOrFail($key);
        $surveys = $device->surveys;
        return $surveys;
    }

    
    public function store(Request $request){
        $pin = $request->input('pin');
        $key = $request->input('key');
        $p[0] =(int)($pin/1000); 
        $p[1] =(int)($pin/100)  - $p[0] * 10; 
        $p[2] =(int)($pin/10)  - $p[0] * 100 - $p[1] * 10; 
        $p[3] =$pin - $p[0] * 1000 - $p[1] * 100 - $p[2] *10;
        
        $ktab = str_split(strtoupper($key));

        for($k=0;$k<4;$k++)
        {
            for($i=0;$i<4;$i++)
            {
                for($j=0;$j<=(($p[$k]%7)*2)+2;$j++)
                {
                    if($ktab[$i+4*$k+$k] == "Z") $ktab[$i+4*$k+$k] = "0"; else
                    if($ktab[$i+4*$k+$k] == "9") $ktab[$i+4*$k+$k] = "A"; else
                    if(($ktab[$i+4*$k+$k]<"Z"&& $ktab[$i+4*$k+$k]>="A")||($ktab[$i+4*$k+$k]>= "0" && $ktab[$i+4*$k+$k]<"9")) $ktab[$i+4*$k+$k]++;
                }
            }
        }
        $keygen =implode($ktab);
        if ($keygen=="S2GO-3D74-A6B3-S53X")
        {
            $request->merge( ['key'=>$key."-".$pin]);
            return Device::create($request->all());
        }
        else{
            return 501;
        }
        
    }

    public function delete(Request $request, $key){
        $device = Device::findOrFail($key);
        $device->surveys()->delete();
        $device->delete();
        return 204;
    }
}
