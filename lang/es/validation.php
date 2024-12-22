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
    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El campo :attribute debe ser una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_dash' => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y números.',
    'array' => 'El campo :attribute debe ser un conjunto.',
    'ascii' => 'El campo :attribute solo debe contener caracteres alfanuméricos y símbolos de un solo byte.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
        'file' => 'El campo :attribute debe estar entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe estar entre :min y :max caracteres.',
        ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'can' => 'El campo :attribute contiene un valor no autorizado.',
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute debe coincidir con el formato :format.',
    'decimal' => 'El campo :attribute debe tener :decimal lugares decimales.',
    'declined' => 'El campo :attribute debe ser declinado.',
    'declined_if' => 'El campo :attribute debe ser declinado cuando :other es :value.',
    'different' => 'El campo :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'El campo :attribute no debe terminar con uno de los siguientes: :values.',
    'doesnt_start_with' => 'El campo :attribute no debe comenzar con uno de los siguientes: :values.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes: :values.',
    'enum' => 'El :attribute seleccionado es inválido.',
    'exists' => 'El :attribute seleccionado es inválido.',
    'extensions' => 'El campo :attribute debe tener una de las siguientes extensiones: :values.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'string' => 'El campo :attribute debe ser mayor que :value caracteres.',
    ],
    'gte' => [
        'array' => 'El campo :attribute debe tener :value elementos o más.',
        'file' => 'El campo :attribute debe ser mayor o igual que :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
        'string' => 'El campo :attribute debe ser mayor o igual que :value caracteres.',
    ],
    'hex_color' => 'El campo :attribute debe ser un color hexadecimal válido.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es inválido.',
    'in_array' => 'El campo :attribute debe existir en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'list' => 'El campo :attribute debe ser una lista.',
    'lowercase' => 'El campo :attribute debe estar en minúsculas.',
    'lt' => [
        'array' => 'El campo :attribute debe tener menos de :value elementos.',
        'file' => 'El campo :attribute debe ser menor que :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser menor que :value.',
        'string' => 'El campo :attribute debe ser menor que :value caracteres.',
    ],
    'lte' => [
        'array' => 'El campo :attribute no debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser menor o igual que :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser menor o igual que :value.',
        'string' => 'El campo :attribute debe ser menor o igual que :value caracteres.',
    ],
    'mac_address' => 'El campo :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
        'file' => 'El campo :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe ser mayor que :max caracteres.',
    ],
    'max_digits' => 'El campo :attribute no debe tener más de :max dígitos.',
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
        'file' => 'El campo :attribute debe tener al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe ser al menos :min caracteres.',
    ],
    'min_digits' => 'El campo :attribute debe tener al menos :min dígitos.',
    'missing' => 'El campo :attribute debe faltar.',
    'missing_if' => 'El campo :attribute debe faltar cuando :other es :value.',
    'missing_unless' => 'El campo :attribute debe faltar a menos que :other sea :value.',
    'missing_with' => 'El campo :attribute debe faltar cuando :values está presente.',
    'missing_with_all' => 'El campo :attribute debe faltar cuando :values están presentes.',
    'multiple_of' => 'El campo :attribute debe ser un múltiplo de :value.',
    'not_in' => 'El :attribute seleccionado es inválido.',
    'not_regex' => 'El formato del campo :attribute es inválido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => [
    'letters' => 'El campo :attribute debe contener al menos una letra.',
    'mixed' => 'El campo :attribute debe contener al menos una letra mayúscula y una minúscula.',
    'numbers' => 'El campo :attribute debe contener al menos un número.',
    'symbols' => 'El campo :attribute debe contener al menos un símbolo.',
    'uncompromised' => 'El :attribute dado ha aparecido en una filtración de datos. Por favor, elige un :attribute diferente.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'present_if' => 'El campo :attribute debe estar presente cuando :other es :value.',
    'present_unless' => 'El campo :attribute debe estar presente a menos que :other sea :value.',
    'present_with' => 'El campo :attribute debe estar presente cuando :values está presente.',
    'present_with_all' => 'El campo :attribute debe estar presente cuando :values están presentes.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato del campo :attribute es inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es requerido cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es requerido cuando :other es aceptado.',
    'required_if_declined' => 'El campo :attribute es requerido cuando :other es declinado.',
    'required_unless' => 'El campo :attribute es requerido a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es requerido cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values están presentes.',
    'required_without' => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de :values está presente.',
    'same' => 'El campo :attribute debe coincidir con :other.',
    'size' => [
    'array' => 'El campo :attribute debe contener :size elementos.',
    'file' => 'El campo :attribute debe ser de :size kilobytes.',
    'numeric' => 'El campo :attribute debe ser :size.',
    'string' => 'El campo :attribute debe tener :size caracteres.',
    ],
    'starts_with' => 'El campo :attribute debe empezar con uno de los siguientes: :values.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'El :attribute ya ha sido tomado.',
    'uploaded' => 'Falló la subida del :attribute.',
    'uppercase' => 'El campo :attribute debe estar en mayúsculas.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'ulid' => 'El campo :attribute debe ser un ULID válido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',

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
        'activities'    => [
            'required'  => 'Debe ingresar al menos una actividad.',
        ],
        'reasons'    => [
            'required'  => 'Las razones son campos obligatorios.',
        ],
        'season'        => [
            'required'  => 'El campo temporada es obligatorio.',
        ],
        'branches'      => [
            'required'  => 'Debe seleccionar al menos una sucursal.',
            'array'     => 'Debe seleccionar al menos una sucursal.',
            'min'       => 'Debe seleccionar al menos una sucursal.',
            'max'       => 'Sólo se acepta una sucursal.',
        ],
        'company_id'    => [
            'required'  => 'Debe seleccionar una empresa.'
        ],
        'name'      =>[
            'required'  => 'El campo nombre es obligatorio.',
            'unique'    => 'Este nombre ya está registrado.'
        ],
        'family'    => [
            'required'  => 'El campo familia es obligatorio.',
        ],
        'order'     => [
            'required'  => 'El campo orden es obligatorio.',
            'numeric'   => 'El campo orden debe ser numérico.',
            'min:1'     => 'El campo orden debe ser mayor a 0.',
        ],
        'email'     => [
            'required'  => 'El campo correo es obligatorio.',
            'email'     => 'El campo correo no es válido.',
            'unique'    => 'Este correo ya está registrado',
        ],
        'address'   => [
            'required'  => 'El campo dirección es obligatorio.',
            'unique'    => 'Esta dirección ya está registrada.',
        ],
        'license_start' => [
            'required'  => 'El campo inicio de licencia es obligatorio.',
            'date'      => 'El campo inicio de licencia debe ser una fecha.',
        ],
        'license_end' => [
            'required'  => 'El campo termino de licencia es obligatorio.',
            'date'      => 'El campo termino de licencia debe ser una fecha.',
            'after'     => 'El campo termino de licencia debe ser posterior al campo inicio de licencia.',
        ],
        'permissions' => [
            'required'  => 'Debe seleccionar al menos un permiso.',
        ],
        'file'          => [
            'required'  => 'Debe ingresar un archivo.',
            'mimes'     => 'No se acepta el tipo de archivo cargado.',
        ],
        'roles' => [
            'required'  => 'Debe seleccionar un rol.',
        ],
        'rut'   => [
            'required'  => 'El campo rut es obligatorio.',
            'unique'    => 'Este rut ya está registrado.',
        ],
        'date'  => [
            'required'  => 'La fecha es un campo obligatorio.',
        ],
        'frecuency_id'  => [
            'required'  => 'Debe seleccionar una frecuencia.',
        ],
        'location_id'   => [
            'required'  => 'Debe seleccionar un sector.',
        ],
        'area_id'       => [
            'required'  => 'Debe seleccionar un área.',
        ],
        'priority_id'   => [
            'required'  => 'Debe seleccionar una prioridad.',
        ],
        'employee_id'   => [
            'required'  => 'Debe seleccionar un encargado',
        ],
        'id_activities' => [
            'required'  => 'Debe seleccionar al menos una actividad.',
        ],
        'priority'      => [
            'required'  => 'Debe seleccionar una prioridad.',
        ],
        'description'   => [
            'required'  => 'El campo descripción es obligatorio.'
        ],
        'title'         => [
            'required'  => 'El campo título es obligatorio.',
        ],
        'category'      => [
            'required'  => 'Debe seleccionar una categoria.',
        ],
        'question'      => [
            'required'  => 'El campo descripción es obligatorio.',
        ],
        'text'          => [
            'required'  => 'El campo descripción es obligatorio.',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
