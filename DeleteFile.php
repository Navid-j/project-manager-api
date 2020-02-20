<?php 
  header('Content-type: application/json; charset=utf-8');
  $path = "uplds/";
  if (isset($_GET['file_name'])) {
    $file_pointer = $_GET['file_name'];  

    if (!unlink($path . $file_pointer)) {  
        $data_response['message'] = "$file_pointer cannot be deleted due to an error";
        $data_response['success'] = 0;
    }  
    else {  
        $data_response['message'] = "$file_pointer has been deleted";
        $data_response['success'] = 1; 
    } 
  } else {
    $data_response['message'] = "Error: Check Imported Data -> 'file_name'";
    $data_response['success'] = 0;
    }
    echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

?>