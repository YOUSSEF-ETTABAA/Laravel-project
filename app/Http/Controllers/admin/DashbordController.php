<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function __invoke(){
        return view('admin.dashboard.index');
   }
}
