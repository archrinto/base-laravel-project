<?php

namespace Modules\Module\Generators;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;

class CrudGenerator {
    protected $module;
    protected $resource;
    protected $actions = [
        'create',
        'edit',
        'delete',
        'index',
        'detail',
        'option'
    ];
    protected $views = [
        'create',
        'edit',
        'index',
        'detail'
    ];

    public function __construct($module, $resource) {
        $this->module = $module;
        $this->resource = $resource;
    }

    public function generate(Array $actions) {
        $this->createControllers($actions);
        $this->createActions($actions);
        $this->createViews($actions);
        $this->createWebRoute($actions);
    }

    public function createControllers($actions) {
        foreach ($actions as $action) {
            $target = 'Http/Controllers/';

            if (in_array($action, $this->actions)) {
                $template = $action;
            } else {
                $template = 'default';
            }
            $filename = $this->resource['model'] . ucfirst($action) .'Controller';

            if ($template) {
                $target .= $filename . '.php';
                $template = 'controllers/' . $template;
                $this->render($template, $target, [
                    'className' => $filename,
                    'module' => $this->module,
                    'resource' => $this->resource,
                ]);
            }
        }

    }

    public function createViews($actions) {
        foreach ($actions as $action) {
            $target = 'Resources/views/';

            if (in_array($action, $this->views)) {
                $template = $action;
            } else {
                $template = 'default';
            }
            $filename = $action . '.blade.php';

            if ($template) {
                $template = 'views/' . $template;
                $this->render($template, $target . $filename , [
                    'module' => $this->module,
                    'resource' => $this->resource,
                ]);
            }

            if ($action == 'index') {
                $datatable = 'views/datatable';
                $this->render($datatable, $target . 'components/datatable.blade.php', [
                    'module' => $this->module,
                    'resource' => $this->resource,
                ]);
            }
        }

    }

    public function createRequests() {

    }

    public function createModels() {

    }

    public function createWebRoute($actions) {
        $this->render('routes/web', 'Routes/web.php', [
            'module' => $this->module,
            'resource' => $this->resource,
            'actions' => $actions,
        ]);
    }

    public function createApiRoute() {

    }

    public function createActions($actions) {
        foreach ($actions as $action) {
            $target = 'Actions/';

            if (in_array($action, $this->actions)) {
                $template = $action;
            } else {
                $template = 'default';
            }
            $filename = ucfirst($action) .'Action';

            if ($template) {
                $template = 'actions/' . $template;
                $this->render($template, $target . $filename . '.php', [
                    'className' => $filename,
                    'module' => $this->module,
                    'resource' => $this->resource,
                ]);
            }
        }
    }

    private function render($templatePath, $targetPath , $data) {
        $templatePath = module_path('Module', 'resources/templates/' . $templatePath . '.blade.php');

        if (!file_exists($templatePath)) return;

        $template = file_get_contents($templatePath, true);
        $template = Blade::render($template, $data);

        $template = str_replace('--php-open-tag--', '<?php', $template);
        $template = str_replace('--at--', '@', $template);
        $template = str_replace('--bro--', '{{', $template);
        $template = str_replace('--brc--', '}}', $template);

        $targetPath = module_path($this->module['name'], $targetPath);

        File::makeDirectory(dirname($targetPath), $mode = 0777, true, true);
        file_put_contents($targetPath, $template);
    }

}
