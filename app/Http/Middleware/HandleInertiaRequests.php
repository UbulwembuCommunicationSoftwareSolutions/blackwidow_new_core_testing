<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        if(($request->user())){
            $admin = $request->user()->isAdmin();
            $permissions = $request->user()->getPermissions();
        }else{
            $admin = false;
            $permissions = [];
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'admin' => $admin,
                'permissions' => $permissions
            ],
            'debugbar' => function () {
                if (app()->bound('debugbar') && app('debugbar')->isEnabled()) {
                    return app('debugbar')->getData();
                }
                return null;
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'success' => session('success'),
                'error' => session('error')
            ]
        ]);
    }
}
