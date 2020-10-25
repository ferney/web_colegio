<?php

/**
 * MiGaLeRiA
 * Copyright (C) 2008-2011 Esteban De La Fuente Rubio (esteban@delaf.cl)
 *
 * Este programa es software libre: usted puede redistribuirlo y/o modificarlo
 * bajo los términos de la Licencia Pública General GNU publicada
 * por la Fundación para el Software Libre, ya sea la versión 3
 * de la Licencia, o (a su elección) cualquier versión posterior de la misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero
 * SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita
 * MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO.
 * Consulte los detalles de la Licencia Pública General GNU para obtener
 * una información más detallada.
 *
 * Debería haber recibido una copia de la Licencia Pública General GNU
 * junto a este programa.
 * En caso contrario, consulte <http://www.gnu.org/licenses/gpl.html>.
 *
 */

/**
 * Galeria de imágenes
 * MiGaLeRiA v6.0
 * @author DeLaF, esteban[at]delaf.cl
 * @version 2011-03-02
 */
class MiGaLeRiA {

	private static $tab; ///< desde donde se empieza a tabular el codigo html

	/**
	 * Buscar las galerias existentes
	 * @return Arreglo con las galerias disponibles
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	private static function buscarGalerias() {
		$galerias = array();
		if ($gestor = opendir(MIGALERIA_DIR.'/galerias')) { // abrir directorio
			while (($archivo = readdir($gestor)) != false) { // leer directorio
				if(is_dir(MIGALERIA_DIR.'/galerias/'.$archivo) && $archivo!='.' && $archivo!='..') { // no considerar . ni ..
					array_push($galerias, $archivo); // guardar nombre del archivo
				}
			}
			closedir($gestor); // cerrar gestor
		}
		unset($gestor, $archivo);
		sort($galerias); // ordenar resultado alfabéticamente
		return $galerias;
	}

	/**
	 * Buscar las imagenes existentes en una galeria
	 * @return Arreglo con las imagenes disponibles de una galeria
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	private static function buscarImagenes($galeria) {
		$imagenes = array();
		if ($gestor = opendir(MIGALERIA_DIR.'/galerias/'.$galeria)) { // abrir directorio
			while (($archivo = readdir($gestor)) != false) { // leer directorio
				if(preg_match('/\.gif|jpe?g|png/', strtolower($archivo))) {
					array_push($imagenes, $archivo); // guardar nombre del archivo
				}
			}
			closedir($gestor); // cerrar gestor
		}
		unset($gestor, $archivo);
		sort($imagenes); // ordenar resultado alfabéticamente
		return $imagenes;
	}

	/**
	 * Mostrar galerias disponibles
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2015-06-22
	 */
	private static function mostrarGalerias () {
		// verificar que existan imagenes en la galeria
		$galerias = self::buscarGalerias();
		if(count($galerias)>0) {
			foreach($galerias as &$galeria) {
				// obtener una imagen thumbnail random para poner en la presentacion de la galeria
				$imagenes = self::buscarImagenes($galeria);
				$thumbnail = $imagenes[rand(0,count($imagenes)-1)];
				// mostrar cuadro con la imagen que representa la galeria
				echo self::generar('galeria.html', array('galeria'=>$galeria, 'url_galeria'=>urlencode($galeria), 'thumbnail'=>$thumbnail), self::$tab+2);
			}
		} else {
			echo self::generar('vacia.html', array('msg'=>MIGALERIA_LANG_GALLERY_EMPTY), self::$tab+2);
		}
	}

	/**
	 * Muestra las fotos de una galería específica
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	private static function mostrarGaleria ($galeria) {
		echo self::generar('volver.html', array('msg'=>MIGALERIA_LANG_GALLERY_GOBACK), self::$tab+2);
		$imagenes = self::buscarImagenes($galeria);
		$nimagen = 0;
		foreach($imagenes as &$imagen) {
			++$nimagen;
			$size = sprintf('%.2f',(filesize(MIGALERIA_DIR.'/galerias/'.$galeria.'/'.$imagen))/1024);
			$tam = getimagesize(MIGALERIA_DIR.'/galerias/'.$galeria.'/'.$imagen);
			// mostrar cuadro con el thumbnail
			echo self::generar('thumbnail.html', array('url_galeria'=>urlencode($galeria), 'nimagen'=>$nimagen, 'galeria'=>$galeria, 'imagen'=>$imagen, 'size'=>$size, 'x'=>$tam[0], 'y'=>$tam[1]), self::$tab+2);
		}

	}

	/**
	 * Mostrar imagen indicada por $galeria e $imagen
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	private static function mostrarImagen ($galeria, $nimagen) {
		// buscar imagen que se desea mostrar
		$imagenes = self::buscarImagenes($galeria);
		$imagen = $imagenes[$nimagen-1];
		// obtener tamaños en bytes y en pixeles
		$size = sprintf('%.2f',(filesize(MIGALERIA_DIR.'/galerias/'.$galeria.'/'.$imagen))/1024);
		$tam = getimagesize(MIGALERIA_DIR.'/galerias/'.$galeria.'/'.$imagen);
		// determinar imagen siguiente e imagen anterior
		$sig = $nimagen + 1;
		$ant = $nimagen - 1;
		$nimagenes = count($imagenes);
		if($sig>$nimagenes) $sig = 1;
		if($ant==0) $ant = $nimagenes;
		// definir comentario de la imagen
		$archivoComentario = MIGALERIA_DIR.'/galerias/'.$galeria.'/'.substr($imagen, 0, strrpos($imagen, '.')).'.txt';
		if(file_exists($archivoComentario)) $comentario = file_get_contents($archivoComentario);
		else $comentario = '';
		unset($archivoComentario);
		// mostrar imagen
		echo self::generar('imagen.html', array('url_galeria'=>urlencode($galeria), 'galeria'=>$galeria, 'ant'=>$ant, 'sig'=>$sig, 'imagen'=>$imagen, 'comentario'=>$comentario, 'size'=>$size, 'x'=>$tam[0], 'y'=>$tam[1]), self::$tab+2);
	}

	/**
	 * Genera la galería de imágenes
	 * @param galeria Galeria que se desea ver
	 * @param imagen Número de la imagen, de una galeria, que se desea ver
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	public static function mostrar ($galeria, $imagen) {

		// definir tabuladores
		self::$tab = !MIGALERIA_HTML ? TAB : MIGALERIA_TAB;

		// decodificar url
		$galeria = urldecode($galeria);

		// determinar titulo
		$titulo = $galeria ? $galeria : MIGALERIA_TITLE;

		// comenzar documento html
		if(MIGALERIA_HTML) echo self::generar('web1.html', array('titulo'=> $titulo));
		else echo self::generar('web1-inc.html', array('titulo'=> $titulo), self::$tab);

		// imprimir galeria
		if($imagen=='' && $galeria=='') self::mostrarGalerias();
		else if($imagen=='' && $galeria!='') self::mostrarGaleria($galeria);
		else if($imagen!='') self::mostrarImagen($galeria, $imagen);

		// fin documento html de la galeria
		if(MIGALERIA_HTML) echo self::generar('web2.html');
		else echo self::generar('web2-inc.html', null, self::$tab);

	}

	/**
	 * Genera el codigo javascript necesario para mostrar una imagen de cada galeria rotando con un enlace hacia la galeria
	 * @param link Enlace hacia la página principal de la galeria (ej: http://example.com/galeria)
	 * @param tab Desde donde se tabulará
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2015-06-22
	 */
	public static function rotar ($link = '.', $tab = TAB) {
		$variables = '';
		$galerias = self::buscarGalerias();
		if(count($galerias)>0) {
			$i=0;
			foreach($galerias as &$galeria) {
				// obtener una imagen thumbnail random para poner en la presentacion de la galeria
				$imagenes = self::buscarImagenes($galeria);
				$thumbnail = $imagenes[rand(0,count($imagenes)-1)];
				// determinar imag, link y name de la galeria
				$imag = $link.'/galerias/'.$galeria.'/thumbnails/'.$thumbnail;
				$name = $galeria;
				// rellenar plantilla para variables en javascript
				$variables .= self::generar('js_var.js', array('i'=>$i, 'imag'=>$imag, 'name'=>$name), $tab+1);
				++$i;
			}
			echo self::generar('js.js', array('link'=>$link, 'variables'=>$variables), $tab);
		}
	}

	/**
	 * Esta método permite utilizar plantillas html en la aplicacion, estas deberán
	 * estar ubicadas en la carpeta template del directorio raiz (de la app)
	 * @param nombrePlantila Nombre del archivo html que se utilizara como plantilla
	 * @param variables Arreglo con las variables a reemplazar en la plantilla
	 * @param tab Si es que se deberán añadir tabuladores al inicio de cada linea de la plantilla
	 * @return String Plantilla ya formateada con las variables correspondientes
	 * @author DeLaF, esteban[at]delaf.cl
	 * @version 2011-03-02
	 */
	public static function generar ($nombrePlantilla, $variables = null, $tab = 0) {

		// definir donde se encuentra la plantilla
		$archivoPlantilla = MIGALERIA_DIR.'/template/'.MIGALERIA_TEMPLATE.'/'.$nombrePlantilla;

		// cargar plantilla
		$plantilla = file_get_contents($archivoPlantilla);

		// añadir tabuladores delante de cada linea
		if($tab) {
			$lineas = explode("\n", $plantilla);
			foreach($lineas as &$linea) {
				if(!empty($linea)) $linea = constant('TAB'.$tab).$linea;
			}
			$plantilla = implode("\n", $lineas);
			unset($lineas, $linea);
		}

		// reemplazar variables en la plantilla
		if($variables) {
			foreach($variables as $key => $valor)
				$plantilla = str_replace('{'.$key.'}', $valor, $plantilla);
		}

		// retornar plantilla ya procesada
		return $plantilla;

        }

}

?>
