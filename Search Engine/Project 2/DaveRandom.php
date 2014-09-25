<?php

   function process_dir($dir,$recursive = FALSE) {
     if (is_dir($dir)) {
       for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
         if (($file != '.' && $file != '..') && (file_exists($path = $dir.'/'.$file))) {
           if (is_dir($path) && ($recursive)) {
             $list = array_merge($list, process_dir($path, TRUE));
           } else {
             $entry = array('filename' => $file, 'dirpath' => $dir);

  //---------------------------------------------------------//
  //                     - SECTION 1 -                       //
  //          Actions to be performed on ALL ITEMS           //
  //-----------------    Begin Editable    ------------------//

   $entry['modtime'] = filemtime($path);

  //-----------------     End Editable     ------------------//
             do if (!is_dir($path)) {
  //---------------------------------------------------------//
  //                     - SECTION 2 -                       //
  //         Actions to be performed on FILES ONLY           //
  //-----------------    Begin Editable    ------------------//

   $entry['size'] = filesize($path);
   if (strstr(pathinfo($path,PATHINFO_BASENAME),'log')) {
     if (!$entry['handle'] = fopen($path,r)) $entry['handle'] = "FAIL";
   }
   
  //-----------------     End Editable     ------------------//
               break;
             } else {
  //---------------------------------------------------------//
  //                     - SECTION 3 -                       //
  //       Actions to be performed on DIRECTORIES ONLY       //
  //-----------------    Begin Editable    ------------------//

  //-----------------     End Editable     ------------------//
               break;
             } while (FALSE);
             $list[] = $entry;
           }
         }
       }
       closedir($handle);
       return $list;
     } else return FALSE;
   }
     
   $result = process_dir('C:/webserver/Apache2/httpdocs/processdir',TRUE);

  // Output each opened file and then close
   foreach ($result as $file) {
     if (is_resource($file['handle'])) {
         echo "\n\nFILE (" . $file['dirpath'].'/'.$file['filename'] . "):\n\n" . fread($file['handle'], filesize($file['dirpath'].'/'.$file['filename']));
         fclose($file['handle']);
     }
   }

?> 