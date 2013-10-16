<?php
 class colorboxWidget extends CWidget {
     var $theme;

     var $triggerclass;

     var $options;

     var $actions;

     var $registerScript;

     public function init(){
         if($this->registerScript){
             Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('application.extensions')."/yiiColorbox/colorbox/colorbox/jquery.colorbox.js"
                ),
                CClientScript::POS_END
            );
            $assetUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions')."/yiiColorbox/colorbox/example".$this->theme);

            Yii::app()->clientScript->registerCssFile(
                    $assetUrl."/colorbox.css"
                );
         }

         $script = '$(".'.$this->triggerclass.'").colorbox('.CJavaScript::encode($this->options).');';
         //return 'jQuery.ajax('.CJavaScript::encode($options).');';
         /*
         if(!empty($this->options)||!empty($this->actions)){
             $script = "{";
             $count = 1;
             $totalOptions = count($this->options)+count($this->actions);
             if(!empty($this->options)){
                foreach($this->options as $optionKey=>$optionValue){
                    $script .= $optionKey.': "'.$optionValue.'"';
                    if($totalOptions>$count){
                        $script .= ", ";
                    }
                    $count++;
                }
             }
             if(!empty($this->actions)){
                foreach($this->actions as $actionKey=>$actionValue){
                    $script .= $actionKey.': '.$actionValue;
                    if($totalOptions>$count){
                        $script .= ", ";
                    }
                    $count++;
                }
             }
             $script .= "}";
         }
         $script = '$(".'.$this->triggerclass.'").colorbox('.$script.')';*/
         Yii::app()->clientScript->registerScript("colorbox_init"+rand("10000", "99999"),$script);
     }
 }
?>
