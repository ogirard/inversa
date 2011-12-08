<?php
function CreateThumb($name, $filename, $new_w, $new_h) {
  $system=explode('.',$name);
  if (preg_match('/jpg|jpeg/',$system[1])) {
    $src_img=ImageCreateFromJPEG($name);
  }
  if (preg_match('/png/',$system[1])) {
    $src_img=ImageCreateFromPNG($name);
  }
}


?>
