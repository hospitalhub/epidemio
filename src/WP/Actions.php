<?php
/**
 * Actions
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
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Epidemio\WP;

use Hospitalplugin\DB\DoctrineBootstrap;
use Epidemio\Entities\Infections;
use Epidemio\Entities\InfectionsCRUD;
/**
 * Actions
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class Actions
{

    /**
     * init
     * 
     * fires all the WP actions and filters
     */
    static function init()
    {
        add_action('wp_ajax_infections_verification_action', array(
            __CLASS__,
            'infectionsVerificationCallback'
        ));
    }

    /**
     * myActionCallback
     * 
     * AJAX action callback
     */
    static function infectionsVerificationCallback()
    {
        // TODO add nonce secutrity
        $data = $_POST['data'];
        $tempData = stripslashes($data);
        $obj = json_decode($tempData);
        try {
        	InfectionsCRUD::obj2DB($obj);
        } catch (Exception $e) {
            // FIXME Logger
            echo "zonk";
            die();
            // TODO HANDLE err
        }
        die();
    }
}
?>
