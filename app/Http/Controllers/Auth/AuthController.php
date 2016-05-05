<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Lang;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Redirect URL when is not authenticated
	 * @var string
	 */
	protected $loginPath = '/login';

	/**
	 * Default redirect after successful authentication
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Default redirect after successful authentication
	 * @var string
	 */
	protected $redirectAfterLogout = '/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['getLogout', 'logout']]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 * @override
	 */
	protected function getFailedLoginMessage()
	{
		return Lang::get('auth.failed');
	}

	/**
	 * Compatibility for future versions
	 * @return view Login View
	 */
	public function showLoginForm()
	{
		return $this->getLogin();
	}

	/**
	 * Compatibility for future versions
	 * @return view Home or back to login if error occur
	 */
	public function login(Request $request)
	{
		return $this->postLogin($request);
	}

	/**
	 * Compatibility for future versions
	 * @return view Login View
	 */
	public function logout()
	{
		return $this->getLogout();
	}
}
