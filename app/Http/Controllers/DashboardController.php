<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // we call to laravel all method in action don't run without auth
     function __construct() {
        // all action without index
       // $this ->middleware(['auth'])->only('index');
         // Just excute index
        //$this ->middleware(['auth'])->except('index');

     }
    public function index () {
        return view ('dashboard/index' , [
            'user' => 'Mohammed Salem',
        ]);
    }
}
