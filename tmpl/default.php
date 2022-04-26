<?php
/**
 * @module     CG Résa Event List
 * Version			: 2.1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
**/

defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;

$layouts_prm = $params->get('layouts');

$events = $comparams['events'];
$aff = '<div class="cg_resa_list">';
if ($events) {
   foreach ($events as $key => $adate) {
		$date = $adate['event'];
		$ouv = $adate['ouv'];
		$lib = $adate['event_lib'];
        $color = $adate['color'];
        $comment = $adate['comment'];
		$line = '<div class="cg_resa_list_line fg-row">';
		$line_size = 0;
        $link = '<a class="plg_cg_resa" title="'.Text::_("CG_RESA_LIST_RESA").'" href="index.php?option=com_cgresa&amp;view=resa&layout=resa&date='.$date.'&time='.str_replace(":","h",$ouv).'&msg='.$lib.'">';
		foreach ($layouts_prm as $layout) {
			$line_size += $layout->div_width;
			$line .= '<div class="cg_resa_list_col fg-c'.$layout->div_width.' fg-cs12 '.$layout->div_align.'" '; 
			$line .= $layout->color == 'true' ? 'style="background-color:'.$color.'">' : '>';
                        if ($layout->islink == "true") $line .= $link;
			if ($layout->div == "lib") {
				$line .= $lib;
			}
			if ($layout->div == "date") {
				$line .= $date;
			}
			if ($layout->div == "comment") {
				$line .= $comment;
			}
                        if ($layout->islink == "true") $line .= '</a>';
			$line .= "</div>";
		}
		if ($line_size < 12) {
			$line .= '<div class="fg-c'.(12 - $line_size).' fg-cs12"></div>';
		}
		$aff .= $line.'</div>';
   }
  
}
$aff .= "</div>";
echo $aff;
?>
