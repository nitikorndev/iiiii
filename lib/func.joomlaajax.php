<?php
$GLOBALS['ajax'] = true;
define('_JEXEC', 1);
define('JPATH_BASE', dirname(dirname(dirname(dirname(dirname(__FILE__))))));
define('DS', DIRECTORY_SEPARATOR);
require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );

JDEBUG ? $_PROFILER->mark('afterLoad') : null;
$mainframe = & JFactory::getApplication('site');
$mainframe->initialise();
JPluginHelper::importPlugin('system');
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;
$mainframe->triggerEvent('onAfterInitialise');
?>
