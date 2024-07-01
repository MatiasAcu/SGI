__Guia para la instalación de forma ‘local’ del SGI__

Instalar y configurar un programa web como el SGI hecho con PHP y MySQL en XAMPP (o similares) es un proceso que involucra varios pasos

__Requisitos Previos__
Asegúrese de tener XAMPP instalado en su computadora. Si no, puedes descargarlo desde el siguiente enlace: https://www.apachefriends.org/es/index.html
El código fuente del SGI, disponible desde el repositorio: https://github.com/MatiasAcu/SGI.
__¡¡¡IMPORTANTE!!!__ 
Para el login mediante los servicios de Google se requiere como dependencia la API de Google. La forma más simple de instalarla es via Composer, mediante '$composer require google/apiclient:"^2.0"'. Luego debera incluir en el archivo 'configuracion.php' las credenciales necesarias disponibles desde el siguiente documento: https://drive.google.com/file/d/1biXdosTEh0mKsouR6yIM3roGBTOkq6Lt/view?usp=drive_link

Paso 1: Instalar y Configurar XAMPP
      
	  -Descargar e Instalar XAMPP:
            Descargue el instalador de XAMPP desde el sitio web oficial.
            Ejecuta el instalador y sigue las instrucciones para instalar XAMPP en su sistema.
      -Iniciar los Servicios de XAMPP:
            Abra el Panel de Control de XAMPP.
            Inicie los módulos de Apache y MySQL.
Paso 2: Configurar el Proyecto PHP
      
	  -Copiar los Archivos del Proyecto:
            Copie la carpeta del SGI a la carpeta htdocs dentro del directorio de instalación de XAMPP (por defecto suele estar en C:\xampp\htdocs en Windows o /opt/lampp/htdocs en Linux).
      -Configurar la Base de Datos:
            Abra el navegador web y diríjase a http://localhost/phpmyadmin.
            Cree una nueva base de datos para su proyecto.
            Importe el archivo sistema_gestion_inventario.sql del proyecto usando la opción "Importar" en phpMyAdmin.
      -Configurar la Conexión a la Base de Datos en PHP:
            Edite el archivo de configuración del SGI para que apunte a la base de datos creada en el paso anterior. Este archivo se llama conexionPDO.php.
            Asegúrese de que los detalles de la conexión (nombre de host, nombre de usuario, contraseña, nombre de la base de datos) sean correctos.

Paso 3: Probar la Aplicación
      
	  -Acceder al Proyecto en el Navegador:
    	  Abra el navegador web y dirijase a http://localhost/…/SistemaGestionInventario.
          (sustituya los tres puntos con el nombre de la carpeta de su proyecto en htdocs).
     -Verificar el Funcionamiento:
          Asegúrese de que todas las páginas se carguen correctamente y que pueda interactuar con la base de datos sin problemas.
Paso 4: Solución de Problemas Comunes (En caso de que los hubiera)
      
	  -Errores de Conexión a la Base de Datos:
          Verificar los detalles de la conexión en el archivo de configuración.
          Asegúrese de que el servicio MySQL esté corriendo en el Panel de Control de XAMPP.
      -Problemas de Permisos:
          Asegúrese de que los archivos y carpetas del proyecto tienen los permisos correctos.
      -Errores de PHP:
          Habilite la visualización de errores de PHP editando el archivo php.ini (busque display_errors y ponlo en On).
          Reinicie Apache desde el Panel de Control de XAMPP después de realizar cambios en php.ini.

Siguiendo estos pasos, debería poder instalar y ejecutar el SGI en XAMPP sin problemas. Si encuentra errores específicos, revise los mensajes de error y busque soluciones específicas a esos problemas.




