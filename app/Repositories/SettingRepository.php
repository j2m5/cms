<?php


namespace App\Repositories;

use App\Models\Setting;

class SettingRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Setting::class;
    }

    public function getSiteSettings($id)
    {
        $theme = $this->startQuery()
            ->select('value')
            ->where('id', $id)
            ->first();
        return $theme->value;
    }

}
