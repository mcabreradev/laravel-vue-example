<div class="col-xs-12 col-md-7">

    <!-- firstname Field -->
    <div class="form-group">
        <label for="firstname">Nombre</label>
        <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
    </div>

    <!-- lastname Field -->
    <div class="form-group">
        <label for="lastname">Apellido</label>
        <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
    </div>

    <!-- email Field -->
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
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