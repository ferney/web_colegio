MiGaLeRiA
=========

MiGaLeRiA corresponde a una aplicación para generar una galería de imágenes sin utilizar bases de datos, solo basta copiar las imágenes en el servidor.

Este fue el segundo de mis proyectos con que me inicié el 2005, eso si, esta versión está basada en la 6.0.1 del año 2011.

Puede ver la aplicación en funcionamiento [aquí](http://mi.delaf.cl/migaleria).

Características
---------------

- Galería de imágenes generadas automáticamente a partir de los archivos en las carpetas.
- Vista previa de las galerías.
- Vista previa de las imágenes mediante *thumbnails*.
- Pie de imagen.
- Links, con imágenes que rotan, hacia la galería.
- Se puede agregar con require o include para integrar en un sitio o bien usar, por defecto, de forma autónoma.
- Diseño de la galería *tableless*.
- Soporte de internacionalización.
- Utiliza plantillas para separar el diseño de la lógica.

Notas sobre las galerías (subdirectorios dentro de *galerias*)
--------------------------------------------------------------

1.  Sólo puede haber un nivel directorio más dentro del directorio *galerias*, ejemplo:

        ./galerias/galeria1
        ./galerias/galeria2

    Si utilizamos ./galerias/galeria1/paseo y ./galerias/galeria2 reconocerá la galería 1 y la 2, las fotos de la carpeta paseo no se incluirán ya que están en un segundo nivel de subdirectorios.

2.  Sólo se permiten imágenes con extension jpg, JPG, jpeg, JPEG, png, PNG, gif y GIF las otras no se mostrarán en la galería.

3.  Para crear los *thumbnails*, se debe ir al directorio *galerias* (a través de la terminal) y ejecutar:

        $ ./thumbnails.sh

    Si da problemas, revisar que el archivo tenga permisos de ejecución. Ademas de estar instalado el comando convert (paquete imagemagick). Si no se pueden generar los *thumbnails* con este script, se pueden subir los mismos (creados en otro software) directamente al directorio *thumbnails* dentro de cada galería.

4.  Los comentarios de las imágenes se deben colocar en la misma carpeta de la imagen, con el mismo nombre pero utilizando la extensión .txt En caso que existan, estos archivos serán agregados automáticamente a la imagen como comentario al pie de la misma.
