ExtDev_multiselect
==================

Plugin for Cotonti CMF. Designed as helper for Cotonti Extension (plugin) developers.

Description
-----------

Extends standard controls types for plugin configuration screen. 
There are no multiselect type control that can be used in Cotonti plugin 
configuration parameters.
This extension (ExtDev_multiselect) extends standard input fields with additional functionality
to select multiple values at once.

With this extension there are three new types of multiselect control.

Features
--------

* Extending plugin configuration UI controls 
* Three new types of multiselect control
* May be used as «supplementary» plugin without modification of current plugin code
* May be used as code snippet in your own plugins
* Easy to implement your own controls
* I18n 

Demo page
---------

Just install and switch to plugin configuration page.

### Comments

Plugin works out from the box. You can see new controls on plugin configuration page.


### How extension works

Hooks only on Extension's own configuration page (switch to `global` mode for tracking all Extensions 
in system). And preprocess plugin parameters to create multiselect controls on Extension config page.

There are added three new types of controls with multiple selection:

* `simplelist` - shows as usual text input field that allowed to select items and presents it as
comma separated list.
* `multiselect` - shows as common selectbox element with multiple selection support
* `checkboxlist` - presented as list of checkboxes.

To enable new stye controls you must add specially named parameter of type text to your plugin setup 
file - `plugname.setup.php` (see `extdev_multiselect.setup.php` for examples).

Rules of naming config variable: 

    `varname_type`, 
         where `varname` - variable name allowed 
               `type` - type of control: simplelist, multiselect, checkboxlist

So to make a multiselect field you can write this code:
`VARNAME_multiselect=01:text:item1,item2,item3,item4,item5:item1,item3:«Multiselect» parameter`

By default extension tracks controls only on own config (testing) page.
If you want to enable multiselect controls in you plugin - enables `Global` mode.


Install
-------

* Unpack, copy files to root folder of your site.
* Install via Admin → Extensions menu (`Administration panel → Extensions`)
* If you plan to use it as «supplementary» for your own plugins - select `global` mode in 
config (`Administration panel → Extensions → ExtDev_multiselect → Configuration`)
and rename Config parameters in you plugin (see below).

### Comments

To use this Extension as helper for your own plug you must add (or rename existing ones) 
parameters of type text. See rules for naming in `How extension works` section.


References
----------

* [Cotonti.com](http://Cotonti.com/) -- Home of Cotonti CMF


