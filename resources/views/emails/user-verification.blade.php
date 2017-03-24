<p>
  <img src="http://www.dposs.gob.ar/oficina-virtual/img/dposs-logo.png">
</p>

<p>Solicitaste a la Oficina Virtual de la D.P.O.S.S.</p>

<p>Para verificar tu email y acceder a nuestros servicios, hacé click en el siguiente link:</p>

<a href="{{ $link = url('verification', $user->verification_token) . '?email=' . urlencode($user->email) }}"> {{ $link }}</a>
