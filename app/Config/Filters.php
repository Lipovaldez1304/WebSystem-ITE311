<?php

namespace Config;  // ← Must be "Config" not "App\Filters"

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use App\Filters\AuthFilter;
use App\Filters\RoleFilter;
use App\Filters\CheckRestriction;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'             => CSRF::class,
        'toolbar'          => DebugToolbar::class,
        'auth'             => AuthFilter::class,
        'role'             => RoleFilter::class,
        'checkRestriction' => CheckRestriction::class,
    ];

    public array $globals = [
        'before' => [
            'csrf' => [
                'except' => ['login', 'login/*', 'register', 'register/*'],
            ],
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $filters = [
        'auth' => [
            'before' => ['dashboard', 'admin/*', 'teacher/*', 'student/*'],
        ],
        // REMOVED - let routes handle role checks
        'checkRestriction' => [
            'before' => ['dashboard', 'admin/*', 'teacher/*', 'student/*'],
        ],
    ];
}

