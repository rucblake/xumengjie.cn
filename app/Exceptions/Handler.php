<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $e)
    {
        $traces = array_slice($e->getTrace(), 0, 10);
        $traces = array_map(function ($item) {
            $values = [];
            foreach (['file', 'line', 'function', 'class'] as $field) {
                $values[$field] = !empty($item[$field]) ? $item[$field] : '';
            }
            return $values;
        }, $traces);
        $exceptionMessage = [
            'exception' => [
                "message" => $e->getMessage(),
                "file"    => $e->getFile(),
                "line"    => $e->getLine(),
                "trace"   => $traces,
            ],
        ];
        Log::warning($e->getMessage(), array_merge($this->context(), $exceptionMessage));
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
        $ret = array(
            'code' => $exception->getCode() == 0 ? 10000 : $exception->getCode(),
            'logs' => [],
            'msg'  =>  $exception->getMessage(),
            'serverTime' => time(),
            'file' => sprintf("%s:%s",$exception->getFile(),$exception->getLine()),
            'stackTrace' => App::isLocal() ? collect($exception->getTrace())->map(function ($trace) {
                return Arr::except($trace, ['args']);
            }):"",
        );
        return new JsonResponse(
            $ret, 200, [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
