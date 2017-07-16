<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $notify=array();
        $notify['notifications']=Auth::user()->Notifications->groupBy('type')->transform(function ($item, $key) {
            return $item->unique('data.link');
        });
        $notify['notifications']=$notify['notifications']->flatten();
        $notify['unreadNotifications']=Auth::user()->unreadNotifications->groupBy('type')->transform(function ($item, $key) {
            return $item->unique('data.link');
        });
         $notify['unreadNotifications']=$notify['unreadNotifications']->flatten();
         return response()->json($notify);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(Auth::user()->unreadNotifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
