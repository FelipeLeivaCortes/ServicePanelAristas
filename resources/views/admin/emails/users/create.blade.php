@extends('admin.emails.template')

@section('title')
    Bienvenido/a {{ $user->name }}
@endsection

@section('content')
    Antes que todo, te queremos dar la más cordial bienvenida al Sistema de Mantención de Embalses, en donde, se te ha
    asignado el rol de <b>{{ $user->roles[0]->name }}</b>. <i>(Para conocer mayor detalles acerca de este rol, te
    recomendamos encarecidamente que te dirigas a la sección Documentos y descargues el manual de usuario del sistema,
    en el cúal, podrás encontrar más detalles acerca de las funciones asociadas a este).</i>
    <br>
    Por otra parte, te comentamos que para poder ingresar al sistema deberás seguir las siguientes instrucciones:
    <br>
    <ol>
        <li>Visitar el sitio <b><a href="https://www.mantencionembalses.com">https://mantencionembalses.com</a></b>
            <i>(Puedes pinchar sobre el enlace y te redirigirá automáticamente)</i></li>
        <li>Ingresar el correo: <b>{{ $user->email }}</b></li>
        <li>Ingresar la contraseña: <b>{{ $pass }}</b></li>
    </ol>
    <br>
    <b>Además te queremos sugerir:</b><br>
    <ul>
        <li>Jamás compartas tu contraseña con alguien más</li>
        <li>Cuando inicies sesión por primera vez, cambia la contraseña asignada por defecto</li>
    </ul>
@endsection