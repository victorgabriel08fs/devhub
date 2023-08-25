<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->scopes(['read:user'])->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        try {
            $authUser = User::where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }
            $user = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'username' => $user->nickname
            ]);

            $response = Http::get('https://api.github.com/users/' . $user->username . '/repos');
            $data = $response->json();

            function formatSlug($name)
            {
                $slug = strtolower($name);
                $slug = str_replace(' ', '_', $slug);
                return $slug;
            }

            foreach ($data as $item) {
                Project::create([
                    'user_id' => $user->id,
                    'name' => str_replace('_', ' ', ucwords($item['name'])),
                    'slug' => formatSlug(ucwords($item['name'])),
                    'github_link' => $item['html_url'],
                    'url' => !str_contains('http', $item['homepage']) ? 'https://www.' . $item['homepage'] : $item['homepage'],
                    'visibility' => 'Public',
                    'started_at' => $item['pushed_at']
                ]);
            }

            return $user;
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }
}
