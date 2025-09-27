<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo json_encode([
    'mail_mailer' => config('mail.default'),
    'mailers' => config('mail.mailers'),
    'from' => config('mail.from'),
]);
