--php-open-tag--

namespace Modules\{{ $module['name'] }}\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class {{ $resource['model'] }}CreateController extends Controller
{

    public function index() {
        $data = [];
        return view('{{ $module['key'] }}::create', $data);
    }

    public function store(Request $request) {

    }
}
