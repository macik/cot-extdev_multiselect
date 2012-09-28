<?PHP
/**
 * Localization file for extdev_multiselect
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2011-2012
 * @license Distributed under BSD license.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = 'extdev_multiselect';

$L['info_desc'] ='Расширение для разработчиков плагинов. Позволяет расширить
стандартные элементы конфигурирования плагинов элементами с множественным выбором.
Для демонстрации установите плагин и зайдите в раздел настроек этого плагина.
Можно использовать в своих плагинах как сторонний «вспомогательный» плагин,
так и просто скопировав необходимый код.';

$L['cfg_track_mode'] = array('Режим работы (демо/глобальный)','в режиме `глобальный` <strong>ExtDev</strong>
				будет отслеживать настройки всех плагинов и при необходимости расширять функционал.
				Т.е. в этом случае <strong>ExtDev</strong> будет работать как «вспомогательный» плагин.');
$L['cfg_track_mode_params'] = array('Демо режим','Глобальный режим');
$L['cfg_jqueryui_js'] = array('Путь к библиотеке jQueryUI (для функций drag`n`drop)','_ПОКА НЕ ИСПОЛЬЗУЕТСЯ_');
$L['cfg_jqueryui_css'] = array('Путь к CSS файлу jQueryUI','_ПОКА НЕ ИСПОЛЬЗУЕТСЯ_');

$L['cfg_test0_simplelist'] = array('Тест элемента «Simple list»','','Для выбора нажмите на один из элементов списка: ','Сбросить выбранные');
$L['cfg_test1_multiselect'] = array('Тест элемента «Multiselect»','вы можете использовать клавиши Shift/Ctrl для выбора нескольких пунктов');
$L['cfg_test2_checklistbox'] = array('Тест элемента «Checkbox list»','');

$L['edm_admin'] = '«Тестовые» параметры используются здесь просто в качестве демонстрации и не влияют на работу самого <strong>ExtDev</strong>.
Вы можете безбоязненно менять и сохранять их.';


?>