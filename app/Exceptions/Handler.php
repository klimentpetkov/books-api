<?php

namespace App\Exceptions;

use App\Constants;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
        if ($exception instanceof TokenInvalidException)
            return response()->json(['error' => Constants::TOKEN_INVALID], Constants::STATUS_BAD_REQUEST);
        else if($exception instanceof TokenExpiredException)
            return response()->json(['error' => Constants::TOKEN_EXPIRED], Constants::STATUS_BAD_REQUEST);
        else if($exception instanceof JWTException)
            return response()->json(['error' => Constants::TOKEN_PROBLEM], Constants::STATUS_BAD_REQUEST);

        if ($exception instanceof ModelNotFoundException)
            return response()->json(['error' => Constants::RESOURCE_NOT_FOUND], Constants::STATUS_NOT_FOUND);

        if ($exception instanceof NotFoundHttpException)
            return response()->json(['error' => Constants::LOCATION_NOT_FOUND], Constants::STATUS_NO_CONTENT);

        return parent::render($request, $exception);
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(Constants::UNATHENTICATED, Constants::STATUS_UNAUTHORIZED);
    }
}
