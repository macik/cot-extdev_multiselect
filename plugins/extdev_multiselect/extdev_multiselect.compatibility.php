<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.main
[END_COT_EXT]
==================== */
/**
 * Precessing Extension configuration screen to extend parameter types
 * with multiselect controls.
 * (Code for compatibility with old Cotonti Siena (prior to 0.9.10))
 *
 * @package extdev_multiselect
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('EXTDEV_MULTISELECT')) {
	if (!function_exists('cot_admin_config_get_titles')) {
		/**
		 * Helper function that generates selection titles.
		 * (ripped from Cotonti 9.10 for backward compatibility)
		 * @param  string $config_name Current config name
		 * @param  array  $cfg_params  Array of config params
		 * @return array               Selection titles
		 */
		function cot_admin_config_get_titles($config_name, $cfg_params)
		{
			global $L;
			if (isset($L['cfg_'.$config_name.'_params'])
							&& is_array($L['cfg_'.$config_name.'_params']))
			{
				$lang_params_keys = array_keys($L['cfg_'.$config_name.'_params']);
				if (is_numeric($lang_params_keys[0]))
				{
					// Numeric array, simply use it
					$cfg_params_titles = $L['cfg_'.$config_name.'_params'];
				}
				else
				{
					// Associative, match entries
					$cfg_params_titles = array();
					foreach ($cfg_params as $val)
					{
						if (isset($L['cfg_'.$config_name.'_params'][$val]))
						{
							$cfg_params_titles[] = $L['cfg_'.$config_name.'_params'][$val];
						}
						else
						{
							$cfg_params_titles[] = $val;
						}
					}
				}
			}
			else
			{
				$cfg_params_titles = $cfg_params;
			}
			return $cfg_params_titles;
		}
	}
	if (!function_exists('cot_checklistbox')) {
		/**
		 * Generates a checklistbox output
		 * @param mixed $chosen Checkbox state
		 * @param string $name Input name
		 * @param array $values Options available
		 * @param array $titles Titles for options
		 * @param mixed $attrs Additional attributes as an associative array or a string
		 * @param string $separator Option separator, by default is taken from $R['input_radio_separator']
		 * @param bool $addnull add nullvalue field for easycheck if chechlisybox is isset on the form
		 * @param string $custom_rc Custom resource string name
		 * @return string
		 */
		function cot_checklistbox($chosen, $name, $values, $titles = array(), $attrs = '', $separator = '', $addnull = true, $custom_rc = '')
		{
			global $R;
			if (!is_array($values))
			{
				$values = explode(',', $values);
			}
			if (!is_array($titles))
			{
				$titles = explode(',', $titles);
			}
			$use_titles = count($values) == count($titles);
			$input_attrs = cot_rc_attr_string($attrs);

			$chosen = cot_import_buffered($name, $chosen);

			if (empty($separator))
			{
				$separator = $R['input_radio_separator'];
			}

			$i = 0;
			$result = '';
			if ($addnull)
			{
				$result .= cot_inputbox('hidden', $name.'[nullval]', 'nullval');
			}
			$rc_name = preg_match('#^(\w+)\[(.*?)\]$#', $name, $mt) ? $mt[1] : $name;

			$rc = empty($custom_rc)
			? empty($R["input_checkbox_{$rc_name}"]) ? 'input_checkbox' : "input_checkbox_{$rc_name}"
			: $custom_rc;
			foreach ($values as $k => $x)
			{
				$i++;
				$x = trim($x);
				$checked = (is_array($chosen) && in_array($x, $chosen)) || (!is_array($chosen) && $x == $chosen) ? ' checked="checked"' : '';
				$title = $use_titles ? htmlspecialchars($titles[$k]) : htmlspecialchars($x);
				if ($i > 1)
				{
					$result .= $separator;
				}
				$result .= cot_rc($rc, array(
								'value' => htmlspecialchars($x),
								'name' => $name.'['.$i.']',
								'checked' => $checked,
								'title' => $title,
								'attrs' => $input_attrs
				));

			}
			return $result;

		}

	}
}

?>