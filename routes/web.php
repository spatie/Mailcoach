<?php

Route::mailgunFeedback('mailgun-feedback');
Route::sesFeedback('ses-feedback');

Route::redirect('/', '/campaigns');
