<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "users";
$TABLE_NAME_MESSAGES = "messages";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8"); // UTF-8 :) After Several Hours

if (isset($_GET['producer_id'])) {
    $ProducerId = $_GET['producer_id'];

    $my_query = "SELECT * FROM " . $TABLE_NAME . " WHERE personnelCode =" . $ProducerId;
    $result = @mysqli_query($Connect, $my_query);
    if ($result) {
        $data_response['info'] = array();
        $data_response['success'] = 1;

        while ($row = @mysqli_fetch_array($result)) {
            $user = array();
            $user['id'] = $row['ID'];
            $user['firstName'] = $row['firstName'];
            $user['lastName'] = $row['lastName'];
            $user['producerId'] = $row['personnelCode'];
            $user['phoneNumber'] = $row['phoneNumber'];
            array_push($data_response['info'], $user);
        }
    } else {
        $data_response['success'] = 0;
        $data_response['error_message'] = "no data";
    }
} else {
    $data_response['Error'] = "producer_id ?";
}
echo json_encode(@$data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);

mysqli_close($Connect);
?>
