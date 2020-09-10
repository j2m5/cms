<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return User::class;
    }

    public function getBlogShow($id)
    {
        $columns = ['id', 'login', 'name', 'email', 'role_id', 'created_at', 'avatar', 'server', 'side', 'char', 'class', 'spec', 'guild', 'age', 'vk', 'ok', 'tw', 'fb'];
        $user = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('role:id,role_value', 'comments:user_id')
            ->first();
        return $user;
    }

    public function getAdminIndex()
    {
        $columns = ['id', 'login', 'name', 'email', 'role_id', 'ip', 'banned', 'created_at', 'updated_at'];
        $users = $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('role:id,role_key,role_value')
            ->paginate(countOnPage());
        return $users;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'login', 'name', 'email', 'role_id', 'ip', 'banned', 'created_at', 'updated_at'];
        $users = $this->startQuery()
            ->select($columns)
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orWhere('login', 'LIKE', '%'.$query.'%')
            ->orWhere('email', 'LIKE', '%'.$query.'%')
            ->latest()
            ->with('role:id,role_key,role_value')
            ->paginate(countOnPage());
        return $users;
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'login', 'name', 'email', 'avatar', 'role_id'];
        $user = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->first();
        return $user;
    }

    public function getUserByEmail($email)
    {
        return $this->startQuery()
            ->select(['*'])
            ->where('email', $email)
            ->first();
    }

}
