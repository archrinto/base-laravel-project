<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu::index');
    }

    public function create()
    {
        return view('menu::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('menu::show');
    }


    public function edit($id)
    {
        return view('menu::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
