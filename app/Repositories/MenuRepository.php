<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Menu::class;
    }

    public function getAdminIndex()
    {
        return $this->startQuery()
            ->select(['*'])
            ->with('menuItems')
            ->get();
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'menu_id', 'parent_id', 'type_id', 'position', 'label', 'url', 'attributes', 'external'];
        return $this->startQuery()
            ->select(['*'])
            ->where('id', $id)
            ->with(['menuItems' => function($query) use ($columns) {
                $query->where('parent_id', 0)
                    ->select($columns);
            }])
            ->first();
    }

    public function getMenuTree()
    {
        return $this->startQuery()
            ->select(['*'])
            ->with(['menuItems' => function($query) {
                $query->where('parent_id', 0);
            }])
            ->get();
    }
}
