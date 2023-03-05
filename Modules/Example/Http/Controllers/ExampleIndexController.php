<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExampleIndexController extends Controller
{

    public function index() {
        $data = [];
        return view('example::index', $data);
    }

}
