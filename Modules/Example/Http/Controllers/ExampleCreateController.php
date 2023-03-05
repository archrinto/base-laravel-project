<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExampleCreateController extends Controller
{

    public function index() {
        $data = [];
        return view('example::create', $data);
    }

    public function store(Request $request) {

    }
}
