<?php

namespace Ecjia\Kernel\Http;

use Royalcms\Component\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Ecjia\Kernel\Http\Middleware\AllowLongRequests',

//		'Royalcms\Component\Cookie\Middleware\EncryptCookies',
//		'Royalcms\Component\Cookie\Middleware\AddQueuedCookiesToResponse',
//		'Royalcms\Component\Session\Middleware\StartSession',
//		'Royalcms\Component\View\Middleware\ShareErrorsFromSession',

	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'verify_csrf_token' => 'Ecjia\Kernel\Http\Middleware\VerifyCsrfToken',

//		'auth' => 'App\Http\Middleware\Authenticate',
//		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
//		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

}
