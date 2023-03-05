<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\Menu\Actions\ViewMenuList;

class MenuApiController extends Controller
{
    public function datatable(Request $request, ViewMenuList $action): JsonResponse
    {
        return response()->json($action->execute([
            'search' => $request->search
        ]));
    }

    public function options(Request $request, ViewMenuList $action) {
        $term = trim($request->search);

        $list = $action->execute([
            'search' => $request->search
        ]);

        $formatted_list = [];
        foreach ($list as $item) {
            $formatted_list[] = ['id' => $item->id, 'text' => $item->name];
        }

        return response()->json($formatted_list);
    }

    public function routes(Request $request) {
        $list = Route::getRoutes();
        $formatted_list = [];
        foreach ($list as $item) {
            if ($item->methods()[0] === 'GET' && !str_starts_with($item->uri(), 'api')) {
                $formatted_list[] = ['id' => $item->getName(), 'text' => $item->getName(), 'path' => $item->uri()];
            }
        }

        return response()->json($formatted_list);
    }
}
