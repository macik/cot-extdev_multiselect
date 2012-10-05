<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.loop,admin.config.edit.first,admin.config.edit.tags
Order=50
[END_COT_EXT]
==================== */
/*
 * Precessing Extension configuration screen to extend parameter types
 * with multiselect controls.
 *
 * Consider 3 parts:
 *		Part1. Hook: admin.config.edit.loop
 *	 		checks parameter name ($config_name) for specified type
 *			extend and creating UI controls for Multiselect
 *
 *		Part 2. Hook: admin.config.edit.first
 *			purify and filters posted parameters before save in DB
 *
 *		Part 3. Hook: admin.config.edit.tags
 *			includes JS code to manage Multiselect controls extension
 *
 **/

if (!defined('COT_CODE')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

if (defined('EXTDEV_MULTISELECT')) {//&& ($config_cat==$plug_name || $dem_cfg['track_mode'])
	if (is_null($config_type) && sizeof($edm_tokens))// Part 3
	{ // inside admin.config.edit.tags hook adding JS code
	$adminhelp .= $L['edm_admin'];
	cot_rc_embed_footer($edm_jstpl->text());
	}
	if ($a == 'update' && is_null($config_type)) // Part 2
	{ // While update CFG (admin.config.edit.first hook)
	  // filters posted values for «multiselect» params
		foreach ($_POST as $param=>$value){
			$config_tokens = explode('_', $param);
			$config_type = 0;
			while (is_numeric($config_type) ) {
				$config_type = array_pop($config_tokens);
			}
			if (in_array($config_type,$edm_types)){
				$sql = $db->query("SELECT * FROM $db_config
								WHERE config_owner = ? AND config_cat = ? AND config_name = ? $where_cat",
								array_merge(array($o, $p,$param),$sub_param));
				while ($row = $sql->fetch())
				{
					$config_variants = array_map('trim', explode(',',$row['config_variants']));
					$config_values = array_unique(array_map('trim', explode(',',$value)));
					// filters unknown values
					foreach ($config_values as $k => &$v) {
						if (!in_array($v, $config_variants)) unset($config_values[$k]);
					}
					$_POST[$param] = implode(',',$config_values);
				}
				$sql->closeCursor();
			}
		}
	}
	if ($config_type === '0')  // Part 1
	{ // while creating params config table
	  // extending only COT_CONFIG_TYPE_TEXT parameters
		$config_tokens = explode('_', $config_name);
		if (sizeof($config_tokens)>1) {
			$config_param = array();
			//$edm_tokens = array();
			while (is_numeric($config_type) ) {
				$config_type = array_pop($config_tokens);
				if (is_numeric($config_type)) $config_param[] = $config_type;
			}
			if ($config_type) {
				$config_variants = array_map('trim', explode(',',$row['config_variants']));
			}
			if (sizeof($config_variants)) {
				// if no jQuery used - allow only «simplelist» type
				if (!$cfg['jquery'] && in_array($config_type,$edm_types)) $config_type = $edm_types[0];
				if (!$cfg['jqueryui'] && $config_type=='dragndrop') $config_type = 'multiselect';
				$config_values = array_unique(array_map('trim', explode(',',$config_value)));
				$config_variants_titles = cot_admin_config_get_titles($config_name, $config_variants);
				$def_attr = array('readonly'=>'readonly','id'=>$config_name);
				switch ($config_type) {
					case 'simplelist':
						$last = $config_variants[sizeof($config_variants)-1];
						$item_list = '';
						foreach ($config_variants as $k=>$item) {
							$config_title = $config_variants_titles[$k];
							$link = cot_rc_link("#$item",$config_title,
											array('onclick'=>"sl_add('$item','$config_name');return false;"));
							$item_list .= ($last==$item) ? cot_rc('edm_lastitem',array('item'=>$link)) :
												 			cot_rc('edm_listitem',array('item'=>$link));
						}
						$config_more .= cot_rc('edm_simplelist',array('info'=>($L['cfg_'.$config_name][2] ? $L['cfg_'.$config_name][2] : 'Select'),'list'=>$item_list ));
						$cl_link = cot_rc_link('#_clear',$L['cfg_'.$config_name][3],array('onclick'=>"sl_clear('$config_name');return false;"));
						$config_more .= cot_rc('edm_listclear',array('clear'=>$cl_link));
						$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
						break;
					case 'multiselect':
							$def_attr['style'] ='display:none;';
							$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
							$config_input .= cot_selectbox($config_values, $config_name.'_source[]', $config_variants, $config_variants_titles, false,
											array('class'=>'multiselect',
															'multiple'=>'multiple',
															'data-target-id'=>$config_name,
															'size'=>(sizeof($config_variants)<10)?sizeof($config_variants):10));
						break;
					case 'checklistbox':
 						$def_attr['style'] ='display:none;';
						$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
						$config_input .= cot_checklistbox($config_values, $config_name.'_source', $config_variants, $config_variants_titles,
										array('class'=>'checklistbox','data-target-id'=>$config_name),(sizeof($config_variants)<10)?'<br />':'');
						break;
/*					case 'dragndrop':
						$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
						$R["input_option_".$config_name.'_source'] = '<option class="dnd_left" value="{$value}"{$selected}>{$title}</option>';
						$config_input .= cot_selectbox($config_values, $config_name.'_source[]', $config_variants, $config_variants_titles, false,
										array('class'=>'dragsource',
														'multiple'=>'multiple',
														'data-target-id'=>$config_name,
														'size'=>(sizeof($config_variants)<10)?sizeof($config_variants):10));
						$R["input_option_".$config_name.'_source'] = '<option class="dnd_right" value="{$value}"{$selected}>{$title}</option>';
						$config_input .= cot_selectbox($config_values, $config_name.'_target[]', array(), $config_variants_titles, false,
										array('class'=>'droptarget',
														'multiple'=>'multiple',
														'data-target-id'=>$config_name,
														'size'=>(sizeof($config_variants)<10)?sizeof($config_variants):10));
 						//$edm_tpl->parse(strtoupper($config_type));
						//$config_more = $edm_tpl->text(strtoupper($config_type));
						break; */
					default: $nothing_to_process = true;// nothing to do
				}

				if ( !$nothing_to_process ) {
					$edm_tokens[$config_type] = true;
					$t->assign(array(
									'ADMIN_CONFIG_ROW_CONFIG' => $config_input,
									'ADMIN_CONFIG_ROW_CONFIG_MORE' => $config_more
					));
					$nothing_to_process = false;
				}
			}
		}
		$config_type = null;
	}
}

?>