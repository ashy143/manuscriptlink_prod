<?php 


/*
  This function extracts all the images inside the folder "/content/manuscriptlink"
*/
function read_all_files($root = '/content/manuscriptlink'){         //directory path for images of manuscript.
  $files  = array('dirs'=>array(),'files'=>array());
  $directories  = array();
  $last_letter  = $root[strlen($root)-1];
  $root  = ($last_letter == '\\' || $last_letter == '/') ? $root : $root.DIRECTORY_SEPARATOR;
 
  $directories[]  = $root;
 
  $file_w = fopen("imagePaths.txt", 'w');
  while (sizeof($directories)) {
    $dir  = array_pop($directories);
    if ($handle = opendir($dir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        $file  = $dir.$file;
        if (is_dir($file)) {
          $directory_path = $file.DIRECTORY_SEPARATOR;
          array_push($directories, $directory_path);
          $files['dirs'][]  = $directory_path;
        } elseif (is_file($file)) {
          if(strpos(realpath($file), '.tif') == false ){
            $files['files'][]  = $file;
            fputs($file_w, realpath($file)."\n");
          }
         
        }
      }
      closedir($handle);
    }
  }
  
  fclose($file_w);
  return $files;
}

read_all_files();


?>
