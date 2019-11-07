<?php

Route::mailcoach('mailcoach');

Route::mailgunFeedback('mailgun-feedback');
Route::sesFeedback('ses-feedback');

Route::redirect('/', '/campaigns');
