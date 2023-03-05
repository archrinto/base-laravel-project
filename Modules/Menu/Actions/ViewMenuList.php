<?php

namespace Modules\Menu\Actions;

use Modules\Menu\Entities\Menu;
use Modules\Menu\Transformers\MenuCollection;


class ViewMenuList {
    public function execute($filter = []) {
        $query = Menu::query();

        if (isset($filter['search']) && !empty($filter['search'])) {
            $query->where('name' ,'ilike', '%' . $filter['search'] . '%');
        }

        return new MenuCollection($query->paginate(10));
    }
}
