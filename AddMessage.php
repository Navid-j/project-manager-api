<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "messages";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['userID'],$_GET['message'], $_GET['file_name'], $_GET['getterID'])) {
    $persCode = $_GET['userID'];
    $message = $_GET['message'];
    $fileName = $_GET['file_name'];
    $getterID = $_GET['getterID'];

    $my_query = "INSERT INTO " . $TABLE_NAME . " (address, description, producerId, getterId) 
            VALUES('$fileName', '$message', '$persCode', '$getterID')";

}else if(isset($_GET['userID'], $_GET['message'], $_GET['getterID'])){
    $persCode = $_GET['userID'];
    $message = $_GET['message'];
    $getterID = $_GET['getterID'];

    $my_query = "INSERT INTO " . $TABLE_NAME . " (description, producerId, getterId) 
            VALUES('$message', '$persCode', '$getterID')";

} else {
    echo "Error: Check Imported Data -> 'message, file_name, getterID'";
    $data_response['success'] = 0;
}

if ($Connect->query($my_query) == true) {
    $data_response['success'] = 1;
    $data_response['message'] = "new Message Send . ";
} else {
    echo "Error: " . $my_query . $Connect->error;
    $data_response['success'] = 0;
}
echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
mysqli_close($Connect);
