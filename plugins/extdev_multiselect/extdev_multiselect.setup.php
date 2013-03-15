<?php
/* ====================
[BEGIN_COT_EXT]
Code=extdev_multiselect
Name=ExtDev Helper: multiselect
Description=Extension development helper to create multiselect element in plugin settings
Version=1.0
Date=2012-Sep-26
Author=Andrey Matsovkin
Copyright=Copyright (c) 2011-2012, Andrey Matsovkin
Notes=If your enjoy my plugin please consider donating to help support future developments. Thanks! mailto:macik.spb@gmail.com
Auth_guests=R1
Lock_guests=W2345A
Auth_members=RW1
Lock_members=2345
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
track_mode=02:select:0,1:0:Tracking mode (demo/global)
jqueryui_js=04:string::./js/jquery_ui/jquery-ui-1.8.23.full.min.js:Path to jQueryUI lib (for drag`n`drop)
jqueryui_css=05:string::./js/jquery_ui/css/redmond/jquery-ui-1.8.23.full.css:Path to jQueryUI css
sep=25:separator:Sep1:Sep2:Separator
test0_simplelist=30:text:item1,item2,item3,item4,item5:item1,item3:Test «Simple list»
test1_multiselect=31:text:item1,item2,item3,item4,item5:item1,item3:Test «Multiselect»
test2_checklistbox=32:text:item1,item2,item3,item4,item5:item1,item3:Test «Checkbox list»
[END_COT_EXT_CONFIG]
==================== */

/**
 * extdev_multiselect plugin for Cotonti CMF
 *
 * @package extdev_multiselect
 * @version 1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2011-2013
 * @license Distributed under BSD license.

test3_dragndrop=33:text:item1,item2,item3,item4,item5:item1,item3:Test «Drag`n`Drop»
test4_taglist=34:text:item1,item2,item3,item4,item5:item1,item3:Test «Tag list»

*
*/

if (!defined('COT_CODE')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }


