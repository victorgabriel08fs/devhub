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
        if ($authUser == 'email') {
            return redirect()->route('login')->with('error', 'Já existe um usuário cadastrado com este email.');
        }
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
            $authUser = User::where('provider_id', $user->id)->where('provider', $provider)->first();
            if ($authUser) {
                return $authUser;
            }

            $usedEmail = User::where('email', $user->email)->first();
            if ($usedEmail) {
                return 'email';
            }

            $newUser = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'username' => $user->nickname
            ]);

            if ($provider == 'github' || $provider == 'gitlab') {
                $url = $provider == 'github' ? 'https://api.github.com/users/' . $user->nickname . '/repos' : 'https://gitlab.com/api/v4/users/' . $user->id . '/projects';
                $response = Http::get($url);
                $data = $response->json();
                function formatSlug($name)
                {
                    $slug = strtolower($name);
                    $slug = str_replace(' ', '_', $slug);
                    return $slug;
                }

                foreach ($data as $item) {
                    Project::create([
                        'user_id' => $newUser->id,
                        'name' => str_replace('_', ' ', ucwords($item['name'])),
                        'slug' => formatSlug(ucwords($item['name'])),
                        'repository_link' => $provider == 'github' ? $item['html_url'] : $item['web_url'],
                        'provider' => ucwords($provider),
                        'url' => $provider == 'github' ? (!str_contains('http', $item['homepage']) ? 'https://www.' . $item['homepage'] : $item['homepage']) : null,
                        'visibility' => 'Public',
                        'started_at' => $provider == 'github' ? $item['pushed_at'] : $item['created_at']
                    ]);
                }
            }

            return $newUser;
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }
}
