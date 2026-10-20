<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('portal:info', function () {
    $this->comment('IT Student Portal');
})->purpose('Display the portal name');
