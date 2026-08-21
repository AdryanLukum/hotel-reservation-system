<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // Aturan Redirect Guest (Bawaan aslimu)
        $middleware->redirectGuestsTo(function ($request) {
            // Jika URL diawali dengan 'admin', lempar ke login admin
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            
            // Selain itu, lempar ke login tamu biasa
            return route('login');
        });

        // ==========================================
        // TAMBAHKAN KODE ALIAS ROLE DI SINI
        // ==========================================
        $middleware->alias([
            'role' => \App\Http\Middleware\CekRole::class
        ]);

    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();