<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        (empty($user->name)) ? $user->name = $user->login : $user->name;
        $user->ip = request()->ip();
        $user->password = Hash::make($user->password);
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $event = new Event();
        $event->create([
            'model' => 'User',
            'event_type' => 'created',
            'data' => [
                'user' => (isset(auth()->user()->login)) ? auth()->user()->login : $user->login,
                'target' => $user->login,
                'add' => null,
                'action' => 'зарегистрировался',
                'css' => 'fas fa-user bg-success'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        (empty($user->name)) ? $user->name = $user->login : $user->name;
        ($user->isDirty('password')) ? $user->password = Hash::make($user->password) : $user->password;
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $action = 'обновил пользователя';
        $css = 'fas fa-user bg-primary';
        if ($user->isDirty('banned') && $user->banned) {
            $action = 'забанил пользователя';
            $css = 'fas fa-user bg-danger';
        }
        if ($user->isDirty('banned') && !$user->banned) {
            $action = 'разбанил пользователя';
            $css = 'fas fa-user bg-success';
        }
        if (isset(auth()->user()->login) && auth()->user()->login === $user->login) $action = 'обновил свои учетные данные';
        else $action = 'восстановил пароль';
        $event = new Event();
        $event->create([
            'model' => 'User',
            'event_type' => 'updated',
            'data' => [
                'user' => (isset(auth()->user()->login)) ? auth()->user()->login : getUserLoginByEmail($user->email),
                'target' => $user->login,
                'add' => null,
                'action' => $action,
                'css' => $css
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        $user->posts()->update(['user_id' => 1]);
        $user->comments()->forceDelete();
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $event = new Event();
        $event->create([
            'model' => 'User',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $user->login,
                'add' => null,
                'action' => 'удалил пользователя',
                'css' => 'fas fa-user bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $event = new Event();
        $event->create([
            'model' => 'User',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $user->login,
                'add' => null,
                'action' => 'удалил пользователя',
                'css' => 'fas fa-user bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }
}
