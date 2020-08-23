<?php

namespace App\Http\Controllers\Api\Admin\Traits\Menu;

use App\Repositories\MenuItemRepository;
use Illuminate\Support\Arr;

trait Editable
{
    private function prepareForUpdating(int $id, array $data, int $parent_id = 0)
    {
        $parents = [];
        $children = [];
        $key = 0;
        foreach ($data as $item) {
            $parents[] = [
                'id' => $item['id'],
                'menu_id' => $item['menu_id'],
                'parent_id' => $parent_id,
                'type_id' => $item['type_id'],
                'position' => $key,
                'label' => $item['label'],
                'url' => $item['url'],
                'attributes' => $item['attributes'],
                'external' => $item['external']
            ];
            if (!empty($item['items'])) {
                $children[] = $this->prepareForUpdating($id, $item['items'], $parents[$key]['id']);
            }
            $key++;
        }
        return array_merge($parents, Arr::collapse($children));
    }

    private function updateMenu(int $id, array $data)
    {
        $items = app(MenuItemRepository::class);
        $items = $items->getItemsByMenuId($id);
        $prepared = $this->prepareForUpdating($id, $data);
        foreach ($items as $item) {
            $el = Arr::where($prepared, function ($value) use ($item) {
                return $item->id === $value['id'];
            });
            $item->update(Arr::collapse($el));
        }
    }
}
