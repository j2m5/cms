<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $users = $this->userRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'users' => $users], 200);
    }

    public function create()
    {
        $roles = $this->roleRepository->getRoles();
        return response()->json(['roles' => $roles], 200);
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->input());
        if (Gate::denies('create', $user)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $user->save();
        return response()->json(['success' => 'Пользователь успешно добавлен'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $authUser = auth()->user()->id;
        $user = $this->userRepository->getAdminEdit($id);
        $roles = $this->roleRepository->getRoles();
        return response()->json(['authUser' => $authUser, 'user' => $user, 'roles' => $roles], 200);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->getAdminEdit($id);
        if (Gate::denies('delete', $user)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $user->update($request->input());
        return response()->json(['success' => 'Пользователь успешно обновлен'], 200);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->getOne($id);
        if (Gate::denies('delete', $user)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if ($user->id === auth()->user()->id) return response()->json(['errors' => 'Невозможно удалить себя'], 423);
        $user->forceDelete();
        return response()->json(['success' => 'Пользователь успешно удален'], 200);
    }

    public function ban($id)
    {
        $user = $this->userRepository->getOne($id);
        if (Gate::denies('update', $user)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if ($user->id === auth()->user()->id) return response()->json(['errors' => 'Невозможно забанить себя'], 423);
        if (!$user->banned) {
            $user->update(['banned' => 1]);
            $message = 'Пользователь забанен';
        }
        else {
            $user->update(['banned' => 0]);
            $message = 'Пользователь разбанен';
        }
        return response()->json(['success' => $message], 200);
    }
}