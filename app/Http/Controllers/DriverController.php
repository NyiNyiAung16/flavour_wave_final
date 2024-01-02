<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(){
        $drivers = Driver::all();
        return response()->json(['drivers' => $drivers]);
    }

    public function storeDriver(DriverStoreRequest $request){
        $cleanData = $request->validated();
        Driver::create($cleanData);
        return back()->with('message',[
            'content' => 'Create Driver is successful.',
            'type' => 'success'
        ]);
    }

    public function storeEditData(Driver $driver,DriverStoreRequest $request){
        $cleanData = $request->validated();
        $driver->update($cleanData);
        return back()->with('message',[
            'content' => 'Edit Driver is successful.',
            'type' => 'success'
        ]);
    }

    public function destroy(Driver $driver){
        $driver->delete();
        return back()->with('message',[
            'content' => 'Delete Driver is successful.',
            'type' => 'success'
        ]);
    }
}
