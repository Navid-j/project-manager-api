<?php
header("Content-type: application/json");
require_once "Config.php";
$TABLE_NAME_MESSAGES = "messages";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['message_id'])) {
    $messageID = $_GET['message_id'];

    $my_query = "SELECT * FROM " . $TABLE_NAME_MESSAGES . " WHERE ID =" . $messageID;
    $result = @mysqli_query($Connect, $my_query);

    if ($result) {
        $data_response['message'] = array();
        $data_response['success'] = 1;

        while ($row = @mysqli_fetch_array($result)) {
            $content = array();
            $content['link'] = $row['address'];
            $content['description'] = $row['description'];
            $content['producerId'] = $row['producerId'];
            array_push($data_response['message'], $content);
        }

    } else {
        $data_response['success'] = 0;
        $data_response['error_message'] = "no data";
    }
} else {
    $data_response['Error'] = "message_id ?";
}

echo json_encode(@$data_response, JSON_PRETTY_PRINT);

mysqli_close($Connect);
?>
