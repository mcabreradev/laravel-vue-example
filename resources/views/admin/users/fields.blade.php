<div class="form-group">
  <label for="email">Email</label>
  <input class="form-control" type="text" name="email" id="email" required value="{{ old('email', $user->email) }}">
</div>

<div class="form-group">
  <label for="name">Nombre</label>
  <input class="form-control" type="text" name="name" id="name" required value="{{ old('name', $user->name) }}">
</div>

@if($user->id == null)
  <div class="form-group">
    <label for="password">Contraseña</label>
    <input class="form-control" type="text" name="password" id="password" required value="{{ old('password', $user->password) }}">
  </div>
@endif

<div class="form-group">
  <label>¿Verificó su email?</label>
  <br>
  <label class="radio-inline">
    <input type="radio" name="verified" value="1" @if(old('verified', $user->verified)) checked @endif> Si
  </label>
  <label class="radio-inline">
    <input type="radio" name="verified" value="0" @if(!old('verified', $user->verified)) checked @endif> No
  </label>
</div>

<div class="form-group">
  <label for="roles">Roles</label>
  <select data-placeholder="Elija los roles para este usuario" class="form-control select2" id="roles" name="roles[]" style="width: 100%" multiple>
    @foreach($roles as $role)
      @if($userRoles->contains($role->id))
        <option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
      @else
        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
      @endif
    @endforeach
  </select>
</div>
