<div class="col-xs-12 col-md-7">

  <!-- name Field -->
  <div class="form-group">
    <label for="name">Nombre completo</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
  </div>

  <!-- email Field -->
  <div class="form-group">
    <label for="email">E-mail</label>
    <input class="form-control" type="email" id="email" name="email"
      value="{{ old('email', $user->email) }}" required @if($user->id) disabled @endif>
  </div>

  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input class="form-control" type="text" id="telefono" name="telefono"
      value="{{ old('telefono', $user->telefono) }}">
  </div>
</div>

<div class="col-xs-12 col-md-5">
  @include('users.password')
</div>
