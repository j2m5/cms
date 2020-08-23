<?php


namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Role::class;
    }

    public function getRoles()
    {
        $columns = ['id', 'role_key', 'role_value'];
        $roles = $this->startQuery()
            ->select($columns)
            ->get();
        return $roles;
    }

}
