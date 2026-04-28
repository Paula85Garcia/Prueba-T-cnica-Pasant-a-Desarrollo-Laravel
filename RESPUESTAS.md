# RESPUESTAS.md — Parte Teórica

## 1. ¿Qué es el patrón MVC?
Es una forma de organizar el código en tres capas: el **Modelo** maneja la lógica de negocio y los datos (interactúa con la base de datos), la **Vista** es lo que el usuario ve (HTML, interfaces), y el **Controlador** actúa como intermediario: recibe las peticiones, le pide datos al modelo y se los pasa a la vista.

## 2. GET vs POST
GET se usa para obtener información sin modificar nada en el servidor (por ejemplo, ver los planes disponibles). POST se usa cuando enviamos datos que crean o modifican algo (por ejemplo, suscribirse a un plan enviando usuario y contraseña). GET puede verse en la URL; POST no.

## 3. ¿Qué es Eloquent?
Es el ORM de Laravel. Resuelve el problema de tener que escribir SQL a mano: te permite interactuar con la base de datos usando clases y métodos de PHP. Por ejemplo, `Tarea::all()` en lugar de `SELECT * FROM tareas`.

## 4. ¿Qué hace `php artisan migrate`?
Ejecuta los archivos de migración pendientes, que son como instrucciones para crear o modificar tablas en la base de datos. Sirven para que todos en el equipo tengan la misma estructura de base de datos sin compartir el archivo físico.

## 5. `==` vs `===` en PHP
`==` compara solo el valor (con conversión de tipos), entonces `1 == '1'` es `true`. `===` compara valor y tipo, entonces `1 === '1'` es `false` porque uno es entero y el otro string.

## 6. Composer / install vs update
Composer es el gestor de dependencias de PHP (como npm para JS). `composer install` instala exactamente las versiones que están en el archivo `composer.lock` (ideal para reproducir un entorno). `composer update` busca versiones más nuevas de los paquetes y actualiza el lock.

## 7. `git pull` vs `git fetch`
`git fetch` descarga los cambios del repositorio remoto pero no los aplica a tu código local; solo los trae para que puedas revisarlos. `git pull` hace fetch y además fusiona automáticamente esos cambios con tu rama actual.
