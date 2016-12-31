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
