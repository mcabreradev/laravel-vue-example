<div class="col-xs-12 col-md-7">

    <!-- name Field -->
    <div class="form-group">
        <label for="name">Nombre completo</label>
        <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <!-- email Field -->
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input class="form-control" type="email" id="email" name="email"
          value="{{ old('email', $user->email) }}" required @if($user->id) disabled @endif>
    </div>
</div>

<div class="col-xs-12 col-md-5">
    @include('users.password')
</div>

<div class="col-xs-12">
    <div class="form-group">
        <div class="pull-right">
            <button class="btn btn-success" type="submit">
                <span class="fa fa-check"></span> Guardar
            </button>
        </div>
    </div>
</div>
