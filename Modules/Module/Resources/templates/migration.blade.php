--php-open-tag--

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration

    public function up() {
        Schema::create('{{ $tableName }}', function (Blueprint $table) {
            $table->uuid('id')->primary();
    @foreach($fields as $field)
    @php
        $stringColumn = '$table->' . $field['type'] . '(\'' . $field['name'] .'\'' ;

        if ($field['type'] == 'enum') $stringColumn .= ', [\''. implode('\',\'', $field['enum']) .'\']' ;
        if ($field['max']) $stringColumn .= ', '.$field['max'];

        $stringColumn .= ')';

        if ($field['unique']) $stringColumn .= '->unique()';
        if ($field['nullable']) $stringColumn .= '->nullable()';
        if ($field['default'] != null) {
            if (in_array($field['type'], ['integer', 'boolean', 'float', 'double'])) {
               $stringColumn .= '->default('.$field['default'] .')';
            } else {
                $stringColumn .= '->default(\''.$field['default'] .'\')';
            }
        }

        $stringColumn .= ';';
    @endphp
    {!! $stringColumn !!}
    @endforeach

            $table->timestamps();
        }
    }

    public function down()
    {
        Schema::dropIfExists('{{ $tableName }}');
    }
};
