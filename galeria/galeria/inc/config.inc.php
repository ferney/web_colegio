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

define('MIGALERIA_TITLE', 'Galería de imágenes');
define('MIGALERIA_DIR', dirname(dirname(__FILE__)));
define('MIGALERIA_TEMPLATE', 'default');
define('MIGALERIA_HTML', true); // =true se generaran etiquetas html, head, body, etc, =false se incluira dentro de otro sitio (usando require o include)
define('MIGALERIA_TAB', 2); // depende del diseño de template utilizado

defined('LANG') or define('LANG', 'es');
defined('TAB') or define('TAB', 4);

?>
