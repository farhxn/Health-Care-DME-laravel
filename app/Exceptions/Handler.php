<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException; // Import ValidationException
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    // /**
    //  * Render an exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Throwable  $exception
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  */
    // public function render($request, Throwable $exception)
    // {
    //     // First, check if it's a ValidationException
    //     if ($exception instanceof ValidationException) {
    //         // Let Laravel handle the ValidationException by redirecting back with errors
    //         return parent::render($request, $exception);
    //     }

    //     // Check if the exception is an instance of HttpException
    //     if ($exception instanceof HttpException) {
    //         $status = $exception->getStatusCode();
    //     } else {
    //         $status = Response::HTTP_INTERNAL_SERVER_ERROR; // 500 status code
    //     }

    //     // Custom error view for non-validation errors
    //     return response()->view('errors.error', ['exception' => $exception], $status);
    // }





    // public function render($request, Throwable $exception)
    // {
    //     // Check if the exception is an instance of HttpException
    //     if ($exception instanceof HttpException) {
    //         $status = $exception->getStatusCode();
    //     } else {
    //         $status = Response::HTTP_INTERNAL_SERVER_ERROR; // 500 status code
    //     }

    //     // Optionally, use a different logic or view for non-HTTP exceptions
    //     // For simplicity, using the same view for all errors here
    //     return response()->view('errors.error', ['exception' => $exception], $status);

    //     // Or you can delegate to the parent class' render method for default handling
    //     // return parent::render($request, $exception);
    // }
}




// <?php

// namespace App\Exceptions;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Throwable;

// class Handler extends ExceptionHandler
// {
//     /**
//      * The list of the inputs that are never flashed to the session on validation exceptions.
//      *
//      * @var array<int, string>
//      */
//     protected $dontFlash = [
//         'current_password',
//         'password',
//         'password_confirmation',
//     ];

//     /**
//      * Register the exception handling callbacks for the application.
//      */
//     public function register(): void
//     {
//         $this->reportable(function (Throwable $e) {
//             //
//         });
//     }
// }
