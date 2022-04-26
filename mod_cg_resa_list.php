<?php
/**
 * @module     CG Résa List module
 * Version			: 2.1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
**/

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use ConseilGouz\Component\CGResa\Site\Controller\ResaController;

$language = Factory::getLanguage();
$language->load($module->module);

HTMLHelper::_('behavior.keepalive');
// JHtml::_('bootstrap.tooltip');

$comparams = ResaController::getParams();

$modulefield	= 'media/'.$module->module;
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('cgresalist',$modulefield.'/css/cgresalist.css'); 
$wa->registerAndUseStyle('up',$modulefield.'/css/up.css');
if ($params->get('css',''))
    $wa->addInlineStyle($params->get('css','')); 

$layout = 'default'; // default page
require ModuleHelper::getLayoutPath('mod_cg_resa_list', $layout);

