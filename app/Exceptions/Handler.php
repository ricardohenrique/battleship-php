<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        dd(get_class_methods($exception));
//        $status = 400;
//        $status = $exception->getStatusCode() ?? 500;
//        return response()->json([
//            'error' => [
//                'message' => $exception->getMessage(),
//                'file' => $exception->getFile(),
//                'line' => $exception->getLine(),
//                'status' => $status
//            ]
//        ], $status);
        return parent::render($request, $exception);
    }

    /**
     * Convert validation exception to response json
     *
     * @param  \Illuminate\Validation\ValidationException $validationException
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $validationException, $request)
    {
        $errors = $validationException->validator->errors()->getMessages();
        return response()->json($errors, 422);
    }
}
