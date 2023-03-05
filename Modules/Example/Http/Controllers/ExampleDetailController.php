<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExampleDetailController extends Controller
{

    public function index() {
        $data = [];
        return view('example::detail', $data);
    }

}
