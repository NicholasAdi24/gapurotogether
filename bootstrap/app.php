<?php

use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function ($exceptions) {
        // $exceptions->render(function (Throwable $e, $request) {
        //     // 1️⃣ Validation errors → back with errors & input
        //     if ($e instanceof ValidationException) {
        //         return redirect()
        //             ->back()
        //             ->withErrors($e->errors())
        //             ->withInput();
        //     }

        //     // 2️⃣ HTTP exceptions (404, 403, 419, etc.)
        //     if ($e instanceof HttpExceptionInterface) {
        //         $statusCode = $e->getStatusCode();

        //         // Special case: Session expired
        //         if ($statusCode === 419) {
        //             return redirect()
        //                 ->route('login')
        //                 ->with('error', 'Your session has expired. Please log in again.');
        //         }

        //         return response()->view('errors.default', [
        //             'code' => $statusCode
        //         ], $statusCode);
        //     }

        //     // 3️⃣ Fallback for all other errors → 500
        //     return response()->view('errors.default', ['code' => 500], 500);
        // });
    })
    ->create();
