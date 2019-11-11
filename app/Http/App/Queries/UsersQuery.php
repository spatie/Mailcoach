<?php

namespace App\Http\App\Queries;

use Spatie\MailCoach\Http\App\Filters\FuzzyFilter;
use App\Models\User;
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
