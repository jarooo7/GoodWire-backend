<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class SurveyCntroler extends Controller
{
    public function index(){
        return Survey::all();
    }
    
    public function show($id){
        return Survey::find($id);
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
