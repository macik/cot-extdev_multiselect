<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
Order=50
[END_COT_EXT]
==================== */

/**
 * Header file for extdev_multiselect plugin
 *
 * @package extdev_multiselect
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2011-2013
 * @license Distributed under BSD license.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

global $edm_cfg;
$edm_cfg = $cfg['plugin']['extdev_multiselect'];
$plug_name = 'extdev_multiselect';

if (!defined('EXTDEV_OFF') // can be switched off by other plugin
	&& defined('COT_ADMIN') && $_GET['n']=='edit' && $_GET['o']=='plug' && $_GET['m']=='config'
	&& ($_GET['p']==$plug_name || $edm_cfg['track_mode']))
{
	define('EXTDEV_MULTISELECT',true);

	$R['edm_listitem'] = ' {$item},';
	$R['edm_lastitem'] = ' {$item}';
	$R['edm_listclear'] = '<br/>{$clear}';
	$R['edm_simplelist'] = '<br/>{$info}: {$list}';

	// jqueryUI for drag`n`drop functionality. (Not implemented Yet)
/* 	if (file_exists($edm_cfg['jqueryui_js'])) {
		$cfg['jqueryui'] = true;
		cot_rc_add_file($edm_cfg['jqueryui_css']);
		cot_rc_link_footer($edm_cfg['jqueryui_js']);
	}
 */
	global $edm_jstpl,$edm_types;
	$edm_jstpl = new XTemplate(cot_tplfile($plug_name.'.js', 'plug'));
	$edm_jstpl->parse();
	$edm_types = array('simplelist','multiselect','checklistbox');//,'dragndrop','taglist');
}

