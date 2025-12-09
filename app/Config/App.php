<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * Base Site URL
     */
    public string $baseURL = 'http://localhost/ITE311-VALDEZ/';

    /**
     * Allowed hostnames
     */
    public array $allowedHostnames = [];

    /**
     * Index File
     */
    public string $indexPage = '';

    /**
     * URI Protocol
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * Allowed URL Characters
     */
    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    /**
     * Default Locale
     */
    public string $defaultLocale = 'en';

    /**
     * Negotiate Locale
     */
    public bool $negotiateLocale = false;

    /**
     * Supported Locales
     */
    public array $supportedLocales = ['en'];

    /**
     * Timezone
     */
    public string $appTimezone = 'UTC';

    /**
     * Default Charset
     */
    public string $charset = 'UTF-8';

    /**
     * ❗ FIXED: DISABLE force HTTPS completely
     * This was causing the "forcehttps" filter error.
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * Proxy IPs
     */
    public array $proxyIPs = [];

    /**
     * Content Security Policy
     */
    public bool $CSPEnabled = false;

    /**
     * Session Configuration
     */
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'ci_session';
    public int $sessionExpiration = 7200; // 2 hours
    public string $sessionSavePath = WRITEPATH . 'session'; // must exist and writable
    public bool $sessionMatchIP = false;
    public int $sessionTimeToUpdate = 300;
    public bool $sessionRegenerateDestroy = false;
}

