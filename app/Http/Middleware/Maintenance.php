<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class Maintenance
{
    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance())
        {
            return response()->view('error.panel', [
                "code" => 503,
                "title" => 'Maintenace',
                "message" => "Our web service is under maintenance!"
            ]);
        }

        return $next($request);
    }
}
