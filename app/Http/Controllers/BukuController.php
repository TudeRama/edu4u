<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function show($nama){
        return view('show',['buku'=> Admin::where('nama',$nama)->first()]);
    }
}
