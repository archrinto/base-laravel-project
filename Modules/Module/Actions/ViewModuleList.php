<?php

namespace Modules\Module\Actions;


use Illuminate\Support\Facades\Route;

class ViewModuleList {

    public function execute($filter = []) {
        $moduleStatusFile = base_path('modules_statuses.json');
        $moduleStatusList = json_decode(file_get_contents($moduleStatusFile), true);

        $moduleList = collect([]);
        foreach ($moduleStatusList as $name => $status) {
            $moduleList->push([
               'id' => $name,
               'name' => $name,
               'is_active' => $status
            ]);
        }
    }
}
