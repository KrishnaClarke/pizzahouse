<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Simple HTTP Basic protection for the staff pages.
 * Credentials come from ADMIN_USER / ADMIN_PASSWORD in .env (see config/pizza.php).
 */
class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = (string) config('pizza.admin_user');
        $password = (string) config('pizza.admin_password');

        if ($user === '' || $password === '') {
            abort(403, 'Admin credentials are not configured.');
        }

        if (! hash_equals($user, (string) $request->getUser())
            || ! hash_equals($password, (string) $request->getPassword())) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Pizza House Staff"',
            ]);
        }

        return $next($request);
    }
}
