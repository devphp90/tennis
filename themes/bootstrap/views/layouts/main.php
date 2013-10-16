<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'fixed' => '',
            'collapse' => true,
            'fluid' => true,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        //array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        // array('label'=>'Contact', 'url'=>array('/site/contact')),
                        array('label' => 'Register', 'url' => array('/bum/users/signup'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/bum/users/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Profile', 'url' => array('/bum/users/viewProfile', 'id' => Yii::app()->user->id), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'My Sessions', 'url' => array('/bum/usersSession/admin'), 'visible' => !Yii::app()->user->isGuest, 'active' => (Yii::app()->controller->id == 'usersSession') ? 1 : 0,),
                    ),
                ),
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'items' => array(
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    )
                )
            ),
        ));
        ?>

        <div class="container" id="page">

            <?php echo $content; ?>

            <div class="clear"></div>
            <hr/>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by <a target="_blank" href="http://axeo.com">AXEO</a>.<br/>
                All Rights Reserved.<br/>
                Runtime:<?php echo Yii::getLogger()->getExecutionTime() ?>
            </div><!-- footer -->

        </div><!-- page -->


    </body>
</html>
