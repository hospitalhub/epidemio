<?php

/**
 * Menu
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id$ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Epidemio\WP;

/**
 * Menu
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Id$ $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 */
class Menu {
	static function formularz() {
		if (! current_user_can ( 'raport_zakazne' )) {
			wp_die ( __ ( 'Nie masz uprawnień by oglądać tę stronę.' ) );
		}
		require_once __DIR__ . '/../pages/' . current_filter () . '.php';
	}
	static function raport() {
		if (! current_user_can ( 'raporty_zakazne_zbiorczy' )) {
			wp_die ( __ ( 'Nie masz uprawnień by oglądać tę stronę.' ) );
		}
		require_once __DIR__ . '/../pages/' . current_filter () . '.php';
	}
}
?>