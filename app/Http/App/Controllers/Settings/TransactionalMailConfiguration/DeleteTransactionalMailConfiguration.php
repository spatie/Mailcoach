<?php

namespace App\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use App\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class DeleteTransactionalMailConfiguration
{
    public function __invoke(TransactionalMailConfiguration $mailConfiguration)
    {
        flash()->success('The transactional mail configuration has been deleted');

        $mailConfiguration->empty();

        return back();
    }
}
