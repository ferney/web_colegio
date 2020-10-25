#!/bin/bash
#
# GENERADOR DE THUMBNAILS
# MiGaLeRiA v6.0.1
# esteban@delaf.cl - http://mi.delaf.cl/proyectos/migaleria
#

# obtener medidas de los thumbnails
#WIDTH=`php -r 'require("../inc/config.inc.php"); echo MIGALERIA_THUMBNAIL_WIDTH;'`
WIDTH=80;

# procesar galerias
echo "Generando thumbnails ..."
for galeria in *; do
	if [ -d "$galeria" ]; then
		cd "$galeria"
		if [ ! -d tumb ]; then
			mkdir -p thumbnails
		fi
		for imagen in *; do
			if [ -f "$imagen" ] && [ ! -f "thumbnails/$imagen" ]; then
				if [ -n "`echo "$imagen" | sed -n -e '/jpg/p'`" ] || [ -n "`echo "$imagen" | sed -n -e '/JPG/p'`" ]; then
					echo "Procesando: $galeria/$imagen"
					convert "$imagen" -resize x$WIDTH "thumbnails/$imagen"
				fi
			fi
		done
		cd ..
	fi
done
echo "Ok"
