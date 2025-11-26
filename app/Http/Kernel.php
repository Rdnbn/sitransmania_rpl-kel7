protected $routeMiddleware = [
    // bawaan Laravel
    'auth' => \App\Http\Middleware\Authenticate::class,
    
    // custom middleware
    'role' => \App\Http\Middleware\CheckRole::class,
];