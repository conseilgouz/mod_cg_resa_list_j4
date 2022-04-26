<?php
/**
 * @module     CG Résa Event List
 * Version			: 2.1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
**/
namespace ConseilGouz\Module\CGResaList\Site\Helper;
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Registry\Registry;
use ConseilGouz\Component\CGResa\Site\Controller\ResaController;

class CGResaListHelper
{
	public static function getParams() {
        return  ResaController::getParams();
    }
    // delete passed dates
    public static function clean($lesparams,$table) {
        $excepts = $lesparams['days'];
        $conges = $lesparams['conges'];
        $events = $lesparams['events'];
        $updated = false;
        if ($excepts) {
            foreach ($excepts as $key => $adate) {
                if (strtotime($adate['exception'].' 23:59:59') < time())  {
                    unset($excepts[$key]);
                    $updated = true;
                }
            }
        }
        if ($conges) {
            foreach ($conges as $key => $adate) {
                if (strtotime($adate['congesfin'].' 23:59:59') < time())  {
                    unset($conges[$key]);
                    $updated = true;
                }
            }
        }
        if ($events) {
            foreach ($events as $key => $adate) {
                if (strtotime($adate['event'].' 23:59:59') < time())  {
                    unset($events[$key]);
                    $updated = true;
                }
            }
        }
        if ($updated) { // store updated parameters
            $lesparams['days'] = $excepts;
            $lesparams['conges'] = $conges;
            $lesparams['events'] = $events;
            $table->upd_params(json_encode($lesparams));
            $table->store();
        }
        return $lesparams;
    }   
}
