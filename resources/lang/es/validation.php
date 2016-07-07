<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute debe ser un enlace válido.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y guiones.',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un arreglo.',
    'before'               => 'El campo :attribute debe ser una fecha inferior a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe estar comprendido entre :min y :max.',
        'file'    => 'El archivo :attribute debe estar comprendido :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe estar comprendido :min y :max caracteres.',
        'array'   => 'El campo :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero falso.',
    'confirmed'            => 'El campo :attribute no confirma correctamente.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_format'          => 'El campo :attribute debe cumplir el formato :format.',
    'different'            => 'El campo :attribute y :other deben ser distintos.',
    'digits'               => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe estar comprendido :min y :max dígitos.',
    'distinct'             => 'El campo :attribute posee un valor existente y no puede duplicarse.',
    'email'                => 'El campo :attribute debe ser una dirección de email correcta.',
    'exists'               => 'El campo :attribute elegido es inválido.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute elegido es inválido.',
    'in_array'             => 'El campo :attribute sólo puede ser :other.',
    'integer'              => 'El campo :attribute debe ser un entero.',
    'ip'                   => 'El campo :attribute debe ser un dirección IP correcta.',
    'json'                 => 'El campo :attribute debe ser un JSON.',
    'max'                  => [
        'numeric' => 'El campo :attribute no puede ser más grande que :max.',
        'file'    => 'El archivo :attribute no debe superar :max kilobytes.',
        'string'  => 'El campo :attribute no debe superar los :max caracteres.',
        'array'   => 'El campo :attribute no debe tener más de :max items.',
    ],
    'mimes'                => 'El campo :attribute debe ser uno de los siguientes tipos: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser menor que :min.',
        'file'    => 'El campo :attribute debe poseer al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe tener por lo menos :min characters.',
        'array'   => 'El campo :attribute debe tener por lo menos :min items.',
    ],
    'not_in'               => 'El campo :attribute elegido es inválido.',
    'numeric'              => 'El campo :attribute debe ser un número.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El campo :attribute no respeta el formato requerido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido an menos que el campo :other tenga alguno de los siguientes valores: :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando los valores :values están presentes.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de los campos :values están presentes.',
    'same'                 => 'El campo :attribute y :other deben ser.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El campo :attribute debe tener :size kilobytes.',
        'string'  => 'El campo :attribute debe tener :size caracteres.',
        'array'   => 'El campo :attribute debe tener :size items.',
    ],
    'string'               => 'El campo :attribute debe ser un texto.',
    'timezone'             => 'El campo :attribute debe ser una zona horaria válida.',
    'unique'               => 'El campo :attribute posee un valor ya existente.',
    'url'                  => 'El campo :attribute no tiene un formato válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
