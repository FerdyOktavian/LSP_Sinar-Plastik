<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Command artisan sederhana untuk menampilkan kutipan inspirasi di terminal.
Artisan::command('inspire', function () {
    // Mengirim hasil quote ke output console.
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
