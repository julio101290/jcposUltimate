[![Latest Stable Version](https://poser.okvpn.org/julio101290/jcposultimate/v/stable)](https://packagist.org/packages/julio101290/jcposultimate) [![Total Downloads](https://poser.okvpn.org/julio101290/jcposultimate/downloads)](https://packagist.org/packages/julio101290/jcposultimate) [![Latest Unstable Version](https://poser.okvpn.org/julio101290/jcposultimate/v/unstable)](https://packagist.org/packages/julio101290/jcposultimate) [![License](https://poser.okvpn.org/julio101290/jcposultimate/license)](https://packagist.org/packages/julio101290/jcposultimate)

# JCPOS Ultimate
![image](https://thumbs.odycdn.com/5e3aeb0c2b4ccfbca40039287f186ada.webp)

## Manual de instalación de JCPOS Ultimate



JCPOS Ultimate es un sistema de punto de venta gratuito y de código abierto diseñado para pequeñas y medianas empresas. En este manual, explicaremos cómo instalar y configurar el sistema en su computadora local.


![image](https://thumbs.odycdn.com/5d5dcb5d7154641f49228a1d685fb1b6.webp)


## Requisitos previos

-   Servidor web local: puede utilizar XAMPP, WAMPP o cualquier otro servidor web local.
-   PHP 8.1 o superior
-   MySQL: El sistema utiliza MySQL como base de datos, así que asegúrese de tener MySQL instalado.
-   Descargue el código fuente del repositorio de JCPOS Ultimate en GitHub.

## Instalación Via Composer
	composer create-project julio101290/jcposultimate

## Pasos de instalación

1.  Descargue e instale un servidor web local en su computadora. Si no está seguro de cómo hacerlo, puede seguir las instrucciones específicas para su servidor web local preferido.
2.  Descargue e instale MySQL si aún no lo tiene instalado. Asegúrese de tener acceso a la base de datos raíz y anote las credenciales de inicio de sesión (nombre de usuario y contraseña).
3.  Descargue el código fuente del repositorio de JCPOS Ultimate en GitHub.
4.  Extraiga los archivos del repositorio en el directorio de su servidor web local.
5.  Crea una base de datos en MySQL para JCPOS y levante la base de datos que esta en el archivo .SQL en la carpeta raiz . Puede utilizar cualquier nombre que desee. Asegúrese de crear un usuario con los permisos adecuados y anote las credenciales de inicio de sesión (nombre de usuario y contraseña).
6.  Abra el archivo "configuracion.php" en la carpeta raíz del proyecto con su editor de código preferido.
    
7.  Busque la sección que dice "Configuración de la base de datos" y actualice los valores de las constantes "DB_HOST", "DB_NAME", "DB_USER" y "DB_PASS" con los valores correctos de su base de datos.
    
8.  Abra su navegador web y vaya a la dirección de su servidor web local. Si todo se ha configurado correctamente, debería ver la pantalla de inicio de sesión de JCPOS Ultimate.
9.  Ingrese las credenciales predeterminadas de inicio de sesión:

-   Nombre de usuario: admin
-   Contraseña: admin

10.  Una vez que haya iniciado sesión, puede configurar el sistema de acuerdo con sus necesidades específicas. Asegúrese de cambiar la contraseña de administrador predeterminada por razones de seguridad.

11. En la consola de comandos CMD o Terminal si usan linux pueden iniciar el programa con el siguiente comando
	php.exe -S localhost:8070


¡Felicidades! Ha instalado correctamente JCPOS Ultimate en su computadora local. Ahora puede usarlo para administrar su negocio y realizar ventas.

https://www.youtube.com/watch?v=glFpzKEBN9U&list=PLILw_UuW19gpNvXiJO61x26AqkzGvQ7q1

Tambien podran ver detalladamente los cambios en la siguiente pagina
https://cesarsystems.com.mx/tag/jcpos

## Capturas de pantalla

![image](https://thumbs.odycdn.com/5ccad61a45aee9c8786af20abb41b5c5.webp)


![image](https://thumbs.odycdn.com/450b8db6776c1608b46d5966bcfba034.webp)

![image](https://thumbs.odycdn.com/cb22d901b88ef27ba06b5372ba306e65.webp)
