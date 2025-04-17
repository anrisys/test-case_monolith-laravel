<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {
    public function register()
    {
        $this->renderable(function (BusinessLogicException $e, $request) {
            return inertia()->error($e->getMessage())->setStatusCode($e->getCode());
        });
    
        $this->renderable(function (ModelNotFoundException $e, $request) {
            return inertia()->error($e->getMessage(), 404);
        });

        $this->renderable(function (ValidationException $e, $request) {
            return inertia()->error($e->getMessage(), 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return inertia()->error($e->getMessage(), 404);
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            return inertia()->error($e->getMessage(), 404);
        });
    }
}