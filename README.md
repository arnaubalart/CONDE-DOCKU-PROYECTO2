# Sitio web reservas restaurante
En este sitio web se pueden realizar reservas a todas las mesas de un restaurante.
## Comenzando 🚀
### Pre-requisitos 
Para poder ejecutar correctamente la página, se necesitará tener instalado:
- Xampp o similar
- Un navegador de internet
### Instalación 🔧
En primer lugar deberemos descargarnos todos los archivos del proyecto. Para ello, tenemos dos opciones:
- Usando Git
    - Clonamos el repositorio en local
    - Ya tenemos los archivos en la carpeta
- Descargándonos los ficheros como .zip
    - En la página principal del repositorio, dentro del desplegable abierto pulsando en el botón verde "code", apretar en "Download ZIP".

#### IMPORTANTE crear el archivo config.php dentro de services y que contenga (con los datos de vuestro host de base de datos):

```
 define("SERVIDOR","localhost");
 define("USUARIO","root");
 define("PASSWORD","");
 define("BD","bd_restaurant");
```

#### Para acceder:
###### Hay dos tipos de usuarios:
- David, Arnau, Ivan (inicial en mayúsculas) --> Camareros
- Danny (inicial en mayúsculas) --> Mantenimiento
###### Contraseñas:
- David: qweQWE123
- Arnau: asdASD123
- Ivan: zxcZXC123
- Danny: admin123
## Despliegue 📦
La página está subida al hosting InfinityFree.
Para desplegar el sitio web, se ha creado una nueva base de datos con el fichero sql del proyecto, pero linkeada con el hosting.
Para poder conectar el programa con la base de datos, se ha modificado el fichero config.php con las nuevas credenciales.
Después he subido todos los ficheros al gestor de documentos, y ya se puede ver el proyecto subido a la red.

La url es la siguiente:
www.conde-docku.42web.io
## Construido con 🛠️
- Front-End:
    -  HTML
    - CSS
    - JavaScript
- Back-End:
    - PHP
- Base de Datos
    - SQL
- Con la ayuda de Git y GitHub
## Versionado 📌
La versión actual es la 1.1.5.
## Autores ✒️
Trabajo realizado por: David Ortega, Ivan Aguinaga, Arnau Balart


