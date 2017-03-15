<div class="form-group">
  <label for="display_name">Nombre</label>
  <input class="form-control" type="text" name="display_name" id="display_name" required value="{{ old('display_name', $role->display_name) }}">
</div>

<div class="form-group">
  <label for="name">Clave</label>
  <input class="form-control" type="text" name="name" id="name" required value="{{ old('name', $role->name) }}">
</div>

<div class="form-group">
  <label for="description">Descripción</label>
  <textarea name="description" id="description" rows="3" class="form-control">{{old('description', $role->description)}}</textarea>
</div>

<div class="form-group">
  <label for="permissions">Permisos</label>
  <select data-placeholder="Elija los permisos para este rol" class="form-control select2" id="permissions" name="permissions[]" style="width: 100%" required multiple>
    @foreach($permissions as $permission)
      @if($rolePermissions->contains($permission->id))
        <option value="{{ $permission->id }}" selected>{{ $permission->display_name }}</option>
      @else
        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
      @endif
    @endforeach
  </select>
</div>
