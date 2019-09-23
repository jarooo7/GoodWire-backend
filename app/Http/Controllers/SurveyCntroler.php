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
}
