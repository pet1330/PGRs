<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Entrust;

class MyHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
    	if (Entrust::hasRole('admin')) {
    		return view('admin.pages.dashboard');
    	}
    	elseif (Entrust::hasRole('staff')) {
    		return view('staff.pages.dashboard');
    	}
    	elseif (Entrust::hasRole('student')) {
    		return view('student.pages.dashboard');
    	}
    }
}
