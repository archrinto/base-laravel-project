<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Console\OutputStyle;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Modules\Module\Actions\ViewModuleList;
use Modules\Module\Generators\CrudGenerator;
use Modules\Module\Generators\CustomModuleGenerator;
use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Generators\ModuleGenerator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ViewModuleList $action)
    {
        return view('module::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('module::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $module = [
            'name' => 'Example',
            'key' => 'example',
            'routes' => [
                'create' => 'example/create'
            ],
        ];

        $resource = [
            'name' => 'example',
            'model' => 'Example',
            'api' => 'api/examples',
            'fields' => [
                [
                    'name' => 'first_name',
                    'label' => 'First Name',
                ],
                [
                    'name' => 'last_name',
                    'label' => 'Last Name',
                ],
            ],
            'forms' => [
                [
                    'name' => 'first_name',
                    'label' => 'First Name',
                    'type' => 'text',
                ],
                [
                    'name' => 'first_name',
                    'label' => 'Last Name',
                    'type' => 'text',
                ]
            ],
        ];

        $this->createModule($module['name']);
        $this->createCrud($module, $resource, ['create', 'edit', 'detail', 'delete', 'option', 'index']);
        exit();

        $module = [];
        $module['name'] = 'ModuleName';
        $module['key'] = 'module-name';
        $module['actions'] = ['datatable' => 1];
        $module['routes'] = ['create' => $module['key'] . ':create'];

        $tableName = $request->input('table_name');
        $customTableName = $request->input('custom_table_name');
        $resourceSource = $request->input('resource_source');
        $fieldInputs = $request->input('field');
        $fields = [];
        foreach ($fieldInputs['name'] as $key => $name) {
            $field = [];
            $field['name'] = $fieldInputs['name'][$key];
            $field['type'] = $fieldInputs['type'][$key];
            $field['nullable'] = $fieldInputs['nullable'][$key] == 'true';
            $field['unique'] = $fieldInputs['unique'][$key] == 'true';
            $field['default'] = $fieldInputs['default'][$key];
            $field['min'] = (int) $fieldInputs['min'][$key] ?? null;
            $field['max'] = (int) $fieldInputs['max'][$key] ?? null;
            $field['enum'] = $fieldInputs['enum'][$key] ? explode(',', $fieldInputs['enum'][$key]) : [];

            if (!empty($field['name']) && !empty($field['type'])) {
                $fields[] = $field;
            }
        }

        $migrationTemplate = file_get_contents(module_path('Module', 'resources/templates/migration.blade.php'), true);
        $migrationTemplate = Blade::render($migrationTemplate, [
            'fields' => $fields,
            'tableName' => $tableName
        ]);
        $migrationTemplate = str_replace('--php-open-tag--', '<?php', $migrationTemplate);
        file_put_contents(module_path('Module', 'resources/templates/migration-test.blade.php'), $migrationTemplate);

        // create index resource
        $viewIndexTemplate = file_get_contents(module_path('Module', 'resources/templates/views/index.blade.php'), true);
        $viewIndexTemplate = Blade::render($viewIndexTemplate, [
            'module' => $module
        ]);
        $viewIndexTemplate = str_replace('--at--', '@', $viewIndexTemplate);
        $viewIndexTemplate = str_replace('--bro--', '{{', $viewIndexTemplate);
        $viewIndexTemplate = str_replace('--brc--', '}}', $viewIndexTemplate);
        file_put_contents(module_path('Module', 'resources/templates/views/index-test.blade.php'), $viewIndexTemplate);

        // create datatable resource
        $datatable = [];
        $datatable['id'] = $module['key'] . '-datatable';
        $datatable['name'] = $module['name'] . 'Datatable';
        $datatable['api'] = '/api/' . 'fakes';
        $datatable['columns'] = [
            ['name' => 'first_name', 'title' => 'First Name'],
            ['name' => 'last_name', 'title' => 'Last Name'],
        ];
        $viewDatatableTemplate = file_get_contents(module_path('Module', 'resources/templates/views/datatable.blade.php'), true);
        $viewDatatableTemplate = Blade::render($viewDatatableTemplate, [
            'datatable' => $datatable
        ]);
        $viewDatatableTemplate = str_replace('--at--', '@', $viewDatatableTemplate);
        $viewDatatableTemplate = str_replace('--bro--', '{{', $viewDatatableTemplate);
        $viewDatatableTemplate = str_replace('--brc--', '}}', $viewDatatableTemplate);
        file_put_contents(module_path('Module', 'resources/templates/views/datatable-test.blade.php'), $viewDatatableTemplate);

        // create form resource
        $form_fields = [];
        $form_fields[] = [
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ];
        $form_fields[] = [
            'name' => 'date',
            'label' => 'Datepicker',
            'type' => 'datepicker',
        ];
        $form_fields[] = [
            'name' => 'time',
            'label' => 'Time',
            'type' => 'timepicker',
        ];
        $form_fields[] = [
            'name' => 'daterange',
            'label' => 'Date Range',
            'type' => 'daterangepicker',
        ];
        $viewCreateTemplate = file_get_contents(module_path('Module', 'resources/templates/views/create.blade.php'), true);
        $viewCreateTemplate = Blade::render($viewCreateTemplate, [
            'form_fields' => $form_fields
        ]);
        $viewCreateTemplate = str_replace('--at--', '@', $viewCreateTemplate);
        $viewCreateTemplate = str_replace('--bro--', '{{', $viewCreateTemplate);
        $viewCreateTemplate = str_replace('--brc--', '}}', $viewCreateTemplate);
        file_put_contents(module_path('Module', 'resources/templates/views/create-test.blade.php'), $viewCreateTemplate);

        // controllers
        $controllerCreateTemplate = file_get_contents(module_path('Module', 'resources/templates/controllers/create.blade.php'), true);
        $controllerCreateTemplate = Blade::render($controllerCreateTemplate, [
            'module' => $module
        ]);
        $controllerCreateTemplate = str_replace('--php-open-tag--', '<?php', $controllerCreateTemplate);
        file_put_contents(module_path('Module', 'resources/templates/controllers/create-test.blade.php'), $controllerCreateTemplate);
    }

    public function createModule($name) {
       Artisan::call('module:make', [
           'name' => [$name]
       ]);
    }

    public function createCrud($module, $resource, $actions) {
        (new CrudGenerator($module, $resource))->generate($actions);
    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('module::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('module::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
