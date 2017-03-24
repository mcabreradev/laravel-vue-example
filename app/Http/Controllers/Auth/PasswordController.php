<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Subject del email de recuperacion
     * @var string
     */
    protected $subject = env('EMAIL_RESET_SUBJECT', 'D.P.O.S.S.');

    /**
     * Where to redirect users after password reset.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject = env('EMAIL_RESET_SUBJECT', 'D.P.O.S.S.');
        $this->middleware('guest');
    }

    /**
     * Get the password reset validation messages.
     *
     * @return array
     */
    protected function getResetValidationMessages()
    {
        return [
            'required' => 'Este campo es obligatorio',
            'min' => 'La contraseña debe tener 6 caracteres',
            'confirmed' => 'Las contraseñas ingresadas no coinciden'
        ];
    }
}
