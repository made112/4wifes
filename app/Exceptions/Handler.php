<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            $allowedMethods = $exception->getHeaders()['Allow']; // Get allowed methods from the exception

            return response()->json([
                'message' => 'The requested HTTP method is not supported for this route.',
                'allowed_methods' => $allowedMethods
            ], 405); // Method Not Allowed
        }

        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'يرجى تسجيل الدخول',
            'status' => 'false',
            'code' => '401',

        ], 401);
    }
}
