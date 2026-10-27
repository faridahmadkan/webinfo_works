<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-project', function () {
    $this->comment('Book Registration student project');
})->purpose('Display a short description of the student project');
