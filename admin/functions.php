<?php
   
  function isImage($filename) {
    // если расширение входит в указанный список, то считаем, что это изображение
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $res = in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))? true : false;
    return $res;
  }
  
  function deleteFile($filename) {
    if (file_exists($filename)) unlink($filename);  
  }
    
?>