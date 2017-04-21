<p>
  <img src="http://www.dposs.gob.ar/oficina-virtual/img/dposs-logo.png">
</p>

<p>Solicitaste recuperar tu contraseña para la Oficina Virtual de la D.P.O.S.S.</p>

<p>Para continuar hace click en el siguiente link:</p>

<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>

<p>Si no solicitaste recuperar la contraseña, simplemente ignorá este email.</p>
