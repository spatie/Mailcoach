<?php

namespace App\Http\App\Queries;

use App\Models\User;
use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsersQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(User::query());

        $this
            ->defaultSort('email')
            ->allowedSorts('email', 'name')
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('email', 'name'))
            );
    }
}
