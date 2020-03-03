<?php
header("Content-type: application/json");
require_once "Config.php";
$TABLE_NAME_MESSAGES = "messages";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['getter_id'])) {
    $GetterId = $_GET['getter_id'];

    $my_query = "SELECT * FROM " . $TABLE_NAME_MESSAGES . " WHERE getterId =" . $GetterId;
    $result = @mysqli_query($Connect, $my_query);

    if ($result) {
        $data_response['messages'] = array();
        $data_response['success'] = 1;

        while ($row = @mysqli_fetch_array($result)) {
            $message = array();
            $message['id'] = $row['ID'];
            $message['address'] = $row['address'];
            $message['messageIntro'] = $row['description'];
            $message['producerId'] = $row['producerId'];
            array_push($data_response['messages'], $message);
        }

    } else {
        $data_response['success'] = 0;
        $data_response['error_message'] = "no data";
    }
} else {
    $data_response['Error'] = "getter_id ?";
}

echo json_encode(@$data_response, JSON_PRETTY_PRINT);

mysqli_close($Connect);
?>
