--php-open-tag--

namespace Modules\{{ $module['name'] }}\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class {{ $resource['name'] }} extends Model
{
    use HasFactory;

    protected $fillable = [
        @foreach($resource['fields'] as $field)

        {{ $field['name'] }},
        @endforeach
    ];
}
