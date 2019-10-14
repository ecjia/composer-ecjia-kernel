<?php

namespace Ecjia\Kernel\Exceptions;

use Exception;
use Royalcms\Component\Exception\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Royalcms\Component\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Royalcms\Component\Http\Response
	 */
	public function render($request, Exception $e)
	{
		return parent::render($request, $e);
	}

    protected function whoopsHandler()
    {
        try {
            return royalcms(\Whoops\Handler\HandlerInterface::class);
        } catch (\Illuminate\Contracts\Container\BindingResolutionException $e) {
            return parent::whoopsHandler();
        }
    }

}
