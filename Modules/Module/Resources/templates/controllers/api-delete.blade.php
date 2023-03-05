--php-open-tag--

namespace Modules\{{ $module['name'] }}\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class {{ $resource['model'] }}ApiDeleteController extends Controller
{
    public function destroy($id) {

    }
}
