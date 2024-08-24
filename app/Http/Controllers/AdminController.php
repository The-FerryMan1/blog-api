<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminOnly;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminController extends Controller implements HasMiddleware
{

    public static function middleware(){
        return[
            new Middleware(['auth:sanctum'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return UserLog::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
