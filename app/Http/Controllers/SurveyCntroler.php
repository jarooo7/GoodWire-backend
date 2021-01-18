<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use Carbon\Carbon;

class SurveyCntroler extends Controller
{
    public function index(){
        return Survey::all();
    }
    
    public function show($id){
        return Survey::find($id);
    }

    public function two_h(){
        $current_date_time = Carbon::now()->toDateTimeString(); 
        $from = Carbon::now()->addHours(-2)->toDateTimeString(); 
        return Survey::whereBetween('created_at', [$from, $current_date_time])->get();
    }

    public function show_betweenh($date_time1, $date_time2){
        return Survey::whereBetween('created_at', [$date_time1, $date_time2])->get();
    }

    public function store(Request $request){
        return Survey::create($request->all());
    }

    public function update(Request $request, $id){
        $sur = Survey::findOrFail($id);
        $sur->update($request->all());
        return $sur;
    }

    public function delete(Request $request, $id){
        $sur = Survey::findOrFail($id);
        $sur->delete();
        return 204;
    }
    public function storeD(Request $request){
         $pm1 = $request->input('p1');
	$pm25 = $request->input('p25');
	$pm10 = $request->input('p10');
     	$temperature = $request->input('t');
	$location = $request->input('l');
	$device_id = $request->input('d');
     	$humidity = $request->input('h');
	$pressure = $request->input('p');
	

$rt = $request->input('rt');
	$rm = $request->input('rm');
        $Ro_MQ135 = 92;
        $Ro_F2602 = 6.8563;
        $VRL_MQ135 = $rm*(5.0/1023.0); 
$Rs_MQ135 = ((5.0/$VRL_MQ135)-1)*(10); 
$ratio_MQ135 = $Rs_MQ135/$Ro_MQ135;
$CO = 112.89808 * pow($ratio_MQ135,  -2.868463517);
  $NO =  34.69756084 * pow($ratio_MQ135, -3.422829698);

$VRL_F2602 = $rt*(5.0/1023.0); 
 
   $Rs_F2602 = ((5.0/$VRL_F2602)-1)*(10); 
  $ratio_F2602 = $Rs_F2602/$Ro_F2602;
  $VO =  0.3220722 * pow($ratio_F2602, -0.6007520);
 $HS = 0.38881036 * pow($ratio_F2602, -0.35010059);  
   $NH = 0.92372844 * pow($ratio_F2602,  -0.291578925);


	$req = collect(['pm1'=>$pm1,'pm25'=>$pm25,'pm10'=>$pm10,'location'=>$location,'device_id'=>$device_id ,'temperature'=>$temperature,'pressure'=>$pressure ,'humidity'=>$humidity,'HS'=>$HS,'CO'=>$CO,'NH'=>$NH,'NO'=>$NO,'VO'=>$VO]);
	return Survey::create($req->all());
    }
    public function show_loc($date_time1, $date_time2,$standLat,$standLng,$km){
        $array= Survey::whereBetween('created_at', [$date_time1, $date_time2])->get();
        $aloc=array();
        foreach( $array as $zloc  ){
            $loc=$zloc['location'];
            $clat="O";
            $plng=1;
            $plat=1;
            if (is_numeric(strpos($loc, "N"))){
                $clat="N";
                $plat=1;
            }
            else{
               if (is_numeric(strpos($loc, "S"))){
                   $clat="S";
                   $plat=-1;
                }  
              else{
               continue;}
            }
           if (is_numeric(strpos($loc, "E"))){
               $plng=1;
           }
           else{
                if (is_numeric(strpos($loc, "W"))){
                   $plng=-1;
               }   else{
               continue;
            }
           }
           $lat=substr($loc,0,strpos($loc, $clat));
            $latint= $plat*$lat/100;
            $latint=((($lat/100-(int)($lat/100))/60)*100)+(int)($lat/100)*$plat;
            //$latint= $plat*$lat/100;
            $lng=substr($loc,strpos($loc, $clat)+1,strpos($loc, ".")+6);
            //$lngint= $plng*$lng/100;
            $lngint=((($lng/100-(int)($lng/100))/60)*100)+(int)($lng/100)*$plng;
            $dystans = round (rad2deg(acos(sin(deg2rad($lngint)) * sin(deg2rad($standLng)) + cos(deg2rad($lngint)) * cos(deg2rad($standLng)) * cos(deg2rad($latint - $standLat)))) * 111.18957696);

           if($dystans<=$km){
             array_push($aloc,$zloc);
           }
        }
        return $aloc;
    }
}
							