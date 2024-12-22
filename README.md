## Requisitos

Para poder montar y ejecutar la aplicación correctamente, se debe asegurar que tenga instalado los siguientes componentes
- PHP 8.2.18
- Composer
- Node JS 20.12.2
- DB Browser SQLite 3.12.2

## Configuración Inicial

Para un correcto funcionamiento, es necesario crear un archivo llamado **database.sqlite** en el directorio **database/**.

Una vez creado el archivo, ejecutar los siguientes comandos:

```
composer install
npm install
php artisan migrate:fresh
php artisan db:seed
npm run build
php artisan serve
```

Se recomienda instalar los siguientes plugins para Visual Studio Code
- SQLite Viewer 

