<?php

namespace App\Repositories;

use App\Models\TicketCategory;

class TicketCategoryRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return TicketCategory::class;
    }
}
