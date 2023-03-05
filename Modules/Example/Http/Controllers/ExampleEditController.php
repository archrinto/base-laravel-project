<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExampleEditController extends Controller
{

    public function index() {
        $data = [];
        return view('example::edit', $data);
    }

    public function update(Request $request) {

    }
}
