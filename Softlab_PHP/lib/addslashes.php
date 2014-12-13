<?php
//转义数组
function _addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) {
            $arr[$k] = _addslashes($v);
        }
    }
    return $arr;
}
?>