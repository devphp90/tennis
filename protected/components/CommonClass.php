<?php
class CommonClass extends CComponent {

    /**
     * save the guiders flag and also add if not exist
     */
    public static function guiderFlag($page_id) {
        $user_flag = UsersGuidersFlag::model()->findByAttributes(array('guiders_page_id' => $page_id, 'user_id' => Yii::app()->user->id));

        if (empty($user_flag)) {
            $users_guide = new UsersGuidersFlag;
            $users_guide->user_id = Yii::app()->user->id;
            $users_guide->guiders_page_id = $page_id;
            $users_guide->flag = 1;
            $users_guide->save();
            return true; // show guider

        } elseif ($user_flag->flag == 1) {
            return false; // hide guider

        } else {
            return $user_flag->update(array('flag' => 1)); //show guider
        }

    }
}