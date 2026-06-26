<?php

use App\Providers\AppServiceProvider;
use App\Providers\AdminPanelProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    Laravel\Sanctum\SanctumServiceProvider::class,
];
