<?php

namespace Modules\ModuleName\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ModuleNameCreateController extends Controller
{

    public function index() {
        $data = [];
        return view('module-name::create', $data);
    }

    public function store(Request $request) {

    }
}
