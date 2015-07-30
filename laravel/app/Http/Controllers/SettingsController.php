<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Setting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $all_settings = Setting::all();
        return view('admin.pages.global_settings.index', compact('all_settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $key)
    {
        Setting::set($key, $request->$key);
        Setting::save();
        return redirect()->action('SettingsController@index')->with('success_message', 'Successfully updated \''.$key.'\'');
    }
}
