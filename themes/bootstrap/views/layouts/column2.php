<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span12">

            <?php if (isset($this->header_title)): $this->widget('application.components.HeaderTitle', array('items' => $this->header_title)); endif;?>

            <?php
            if (isset($this->menu)):
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'pills',
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            endif;
            ?>

        <div id="content"><?php echo $content; ?></div>

    </div>

</div>
<?php $this->endContent(); ?>