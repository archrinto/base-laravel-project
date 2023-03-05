--php-open-tag--

namespace Modules\{{ $module['name'] }}\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class {{ $resource['model'] }}EditController extends Controller
{

    public function index() {
        $data = [];
        return view('{{ $module['key'] }}::edit', $data);
    }

    public function update(Request $request) {

    }
}
