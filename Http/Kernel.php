<?php

namespace Ecjia\Kernel\Http;

use RC_Loader;
use RC_Log;
use Royalcms\Component\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
        'Ecjia\Kernel\Http\Middleware\ForceSecureRequests',
        'Ecjia\Kernel\Http\Middleware\TrustProxies',
        'Ecjia\Kernel\Http\Middleware\AllowLongRequests',
        'Ecjia\Kernel\Http\Middleware\PreventRequestsDuringMaintenance',
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

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

	public function bootstrap()
    {
        parent::bootstrap(); // TODO: Change the autogenerated stub

        $this->loadingAppRouteHookSubscriber();
    }

    public function loadingAppRouteHookSubscriber()
    {
        /*
        |--------------------------------------------------------------------------
        | Application Routes
        |--------------------------------------------------------------------------
        |
        | Here is where you can register all of the routes for an application.
        | It's a breeze. Simply tell Royalcms the URIs it should respond to
        | and give it the Closure to execute when that URI is requested.
        |
        */
        collect(config('bundles', []))->map(function ($app) {
            //loading hooks
            RC_Loader::load_app_class('hooks.route_' . $app, $app, false);

            try {
                //loading subscriber
                $bundle = royalcms('app')->driver($app);
                $class = $bundle->getNamespace() . '\Subscribers\RouteHookSubscriber';
                if (class_exists($class)) {
                    royalcms('Royalcms\Component\Hook\Dispatcher')->subscribe($class);
                }
            }
            catch (\InvalidArgumentException $e) {
                RC_Log::error($e->getMessage());
            }
        });
    }


}
