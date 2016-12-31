## TestAPI

Para correr las migraciones tipear 

php artisan migrate

Para anexar data por defecto en las tablas tipear

php artisan db:seed

La BD tiene 4 tablas que son Users, Task, Roles, Priorities

La tabla Roles define los tipos de Usuarios (Administrator, Employee)
La tabla Priorities define las prioridades de las tareas (High, Medium, Slow)

Para iniciar el API desde consola ir hasta la carpeta y tipear php -S localhost:8000 -t public

De igual manera puede anexarse en el Htdocs de Xampp, Wamp o Lamp

## Rutas publicas

{host}/api/auth/login - - Inicio de sesion (Token) - - Metodo POST - - Recibe email y password como Request (Por defecto test@admin.com , 123456 )

## Rutas Privadas

{host}/api/users/me - - Informacion de Usuario - - Metodo GET (La informacion se obtiene por el JWT)

{host}/api/users/info/{email} - - Informacion de Usuario recibiendo email - - Metodo GET

{host}/api/users - - Devuelve todos los usuarios - - Metodo GET

{host}/api/users - - Actualiza datos de usuario - - Metodo PUT - - Recibe lastname y firstname como Request

{host}/api/users/roles - - Actualiza Rol de Usuario - - Metodo PUT - - Recibe role y email como Request

{host}/api/users - - Creacion de Usuarios - - Metodo POST - - Recibe firstname, lastname, email, password y role como Request

{host}/api/task - - Creacion de Tareas - - Metodo POST - - Recibe title, description, due_date, assigned_to, priority

{host}/api/task - - Devuelve tareas asignadas ordenadas por prioridad - - Metodo GET

Servicios probados via Postman
