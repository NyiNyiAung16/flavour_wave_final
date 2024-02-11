<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request){
        $cleanData = $request->validate([
            'body' => 'required|min:1'
        ]);
        Report::create($cleanData);
    }
}
