<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;

class UsuarioGuard extends SessionGuard
{
    /**
     * Create a new authentication guard.
     *
     * @param  string  $name
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @param  \Illuminate\Http\Request|null  $request
     * @return void
     */
    public function __construct($name, $provider, $session, $request = null)
    {
        parent::__construct($name, $provider, $session, $request);
    }

    /**
     * Get the user provider used by the guard.
     *
     * @return \Illuminate\Contracts\Auth\UserProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
