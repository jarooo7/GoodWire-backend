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
        return Device::create($request->all());
    }

    public function delete(Request $request, $key){
        $device = Device::findOrFail($key);
        $device->surveys()->delete();
        $device->delete();
        return 204;
    }
}
