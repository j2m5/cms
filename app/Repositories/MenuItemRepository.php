<?php

namespace App\Repositories;

use App\Models\MenuItem;

class MenuItemRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return MenuItem::class;
    }

    public function getItemsByMenuId($id)
    {
        $columns = ['id', 'menu_id', 'parent_id', 'type_id', 'position', 'label', 'url', 'attributes', 'external'];
        return $this->startQuery()
            ->select($columns)
            ->where('menu_id', $id)
            ->get();
    }

    public function renderMenu($id)
    {
        $columns = ['id', 'menu_id', 'parent_id', 'type_id', 'position', 'label', 'url', 'attributes', 'external'];
        return $this->startQuery()
            ->select($columns)
            ->where('menu_id', $id)
            ->where('parent_id', 0)
            ->orderBy('position')
            ->get();
    }
}
