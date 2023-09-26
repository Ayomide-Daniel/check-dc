<?php

namespace App\Exceptions;

use Throwable;
use ErrorException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use TypeError;

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

        // No query results for model
        // get model name from NotFoundHttpException
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 404);
        });

        // Bad request
        $this->renderable(function (BadRequestException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 400);
        });

        // Unauthorized
        $this->renderable(function (UnauthorizedException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 403);
        });

        // ErrorException
        $this->renderable(function (ErrorException $e, $request) {
            if (!config('app.debug')) {
                return response()->json([
                    "status" => false,
                    "message" => "Oops! Something went wrong. Please try again later.",
                ], 500);
            }
        });

        // AccessDeniedHttpException
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if (!config('app.debug')) {
                return response()->json([
                    "status" => false,
                    "message" => $e->getMessage(),
                ], 403);
            }
        });

        // ValidationException
        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => $e->validator->errors()->first(),
            ], 422);
        });

        // TypeError
        $this->renderable(function (TypeError $e, $request) {
            return response()->json([
                "status" => false,
                "message" => 'Invalid data type'
            ], 422);
        });
    }
}
