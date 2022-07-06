# klothing-tfg

Como levantar la pagina web

Tras la descarga de los ficheros, deberas abrir la terminal de VSCode y realizar los siguientes comandos para poder empezar a programar

-   npm install
-   composer install
-   composer update

- Cosas que modificar antes de iniciar el servidor: 
-   La clase Email.php:
-- Host -> smtp.gmail.com
-- Username -> klothing.tfg@gmail.com
-- Password -> sbthbghsjmwpysrl
-- Port -> 465

-   Dentro de Includes -> Config -> Database.php:
-- Debes introducir la contraseña de tu SQL en el tercer campo de comillas simples.


- Para iniciar el servidor primero debemos acceder a la carpeta public (cd public) desde la terminal de VSCode
- Posteriormente, iniciar el servidor PHP con el comando -> php -S localhost:3000
- Ahora podrá visualizar la pagina web desde su navegador con la url: "localhost:3000"

- Modificar la clase Email con los siguientes datos:


