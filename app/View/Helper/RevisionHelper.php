<?php
/**
 * Created by thang.tran@seamiq.com
 * Date : 3/31/14
 * Time : 1:41 PM
 * Mail : thangcest2@gmail.com 
 * Tel  : 0949 795 597
 * Skype: ducthang_tran167
 */
App::uses('AppHelper', 'View.Helper');
class RevisionHelper extends AppHelper{

    public function restoreUrl($model, $object_id){
        $url = "/revision/index?";
        $url.= 'model='.$model.'&object_id='.$object_id;
        return $url;
    }

    public function showData($jsonData){
        $arrData = json_decode($jsonData, true);
        unset($arrData['id']);
        array_pop($arrData);
        echo "<div>";
        foreach ($arrData as $key=>$value){
            echo "<div><b>".$key."</b> : ".$value."</div>";
        }
        echo "</div>";
    }

} 