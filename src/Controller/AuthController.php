<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\Auth;

/**
 * Class AuthController
 * 
 * Handles authentication-related actions.
 */
class AuthController
{
    /**
     * Display the user's profile.
     *
     * @return mixed Redirects to login page if not logged in, otherwise renders the profile page.
     */
    public function profile()
    {
        if (!Auth::isLoggedIn()) {
            return redirect('/auth/login/');
        }
        return render('auth/profile');
    }

    /**
     * Initiate the user registration process.
     *
     * @return void
     */
    public function register()
    {
        Auth::authClient()->register();
    }

    /**
     * Initiate the user login process.
     *
     * @return void
     */
    public function login()
    {
        Auth::authClient()->login();
    }

    /**
     * Handle the authentication callback.
     *
     * @return mixed Redirects to home page after successful authentication.
     */
    public function callback()
    {
        if (empty($_GET)) redirect('/');
        $token = Auth::authClient()->getToken();
        Auth::authConfig()->setAccessToken($token->access_token);
        $_SESSION['authenticated'] = true;
        return redirect('/');
    }

    /**
     * Log out the current user.
     *
     * @return void
     */
    public function logout()
    {
        // Clear session data
        session_unset();
        session_destroy();

        Auth::authClient()->logout();
    }
}
