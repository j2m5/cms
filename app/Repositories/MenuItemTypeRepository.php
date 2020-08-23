<?php

namespace App\Repositories;

use App\Models\MenuItemType;

class MenuItemTypeRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return MenuItemType::class;
    }
}
