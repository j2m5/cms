<?php

namespace App\Policies;

use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCommentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any blog comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->accessAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the blog comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogComment  $blogComment
     * @return mixed
     */
    public function view(User $user, BlogComment $blogComment)
    {
        //
    }

    /**
     * Determine whether the user can create blog comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the blog comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogComment  $blogComment
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->accessAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the blog comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogComment  $blogComment
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->accessAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the blog comment.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        if ($user->accessAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the blog comment.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        if ($user->accessAdmin()) {
            return true;
        }
        return false;
    }
}
