<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    //'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
    'htmlOptions' => array('style' => 'padding-top: 30px;padding-bottom: 30px;')
)); ?>
<h3><?php echo 'Welcome to '.CHtml::encode(Yii::app()->name);?></h3>

<?php $this->endWidget(); ?>
<p>TennisBridge ETR and Reviews are in pre-release and free to use.<br>Pricing
for various features and services TBD.</p>
<p>Data maybe deleted at any time.</p>
<p>Data security is always a concern for cloud-based apps.<br>Don't enter any
data such as names, photos, or videos that you wish to remain private.<br>You
could anonymize field data by using a made-up User name.</p>
<p>Feedback is appreciated - tennis @ TennisBridge . com</p>
<p><a href="http://www.TennisBridge.com">http://www.TennisBridge.com</a></p>
