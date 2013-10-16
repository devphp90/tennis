<?php
/**
 * Install controller main view file.
 *
 * @copyright	Copyright &copy; 2012 Hardalau Claudiu 
 * @package		bum
 * @license		New BSD License
 *  
 */

/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);

$this->menu=array(    
	array('label'=>'Install with MySQL', 'url'=>array('install/MySQL'), 'visible'=>($this->module->install)),
	array('label'=>'Install with PostgreSQL', 'url'=>array('install/PostgreSQL'), 'visible'=>($this->module->install)),
    
	array('template'=>'<HR style="margin:0 auto;"/>', 'visible'=>($this->module->install)), // separator
    
	array('label'=>'Usefull things (How to?)', 'url'=>array('install/howTo'), 'visible'=>($this->module->install)),
);

?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>Basic User Management (BUM) module aims to be a simple and easy to use module, but in the same time a powerful one in managing users.<br/>
The module does not intend to "reinvent the wheel", so whenever a task not related with user management is needed, 
it make use of other great modules (like yii-mail and/or RBAM).<br/>
This module has a simple and intuitive administration panel and response to basic user administration needs. Enjoy it.<BR/>
<BR/>
Feedback is welcomed. :)<BR/>
</p>

<hr/>
