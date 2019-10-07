<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pin;

class ControllerBaseKey extends Controller
{
    public function index(){
        return Pin::all();
    }
    public function store(Request $request){
        return Pin::create($request->all());
    }

    public function update(Request $request, $id){
        $pin = Pin::findOrFail($id);
        $pin->update($request->all());
        return $pin;
    }

    public function delete(Request $request, $id){
        $pin = Pin::findOrFail($id);
        $pin->delete();
        return 204;
    }
}
