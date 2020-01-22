<?php
header("Content-type: application/json");
require_once "Config.php";
$TABLE_NAME = "projects";
$TABLE_NAME_MESSAGES = "messages";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8"); // UTF-8 :) After Several Hours

if (isset($_GET['producer_id'])) {
    $ProducerId = $_GET['producer_id'];

    $my_query = "SELECT * FROM " . $TABLE_NAME . " WHERE producerId =" . $ProducerId;
    $my_query2 = "SELECT * FROM " . $TABLE_NAME_MESSAGES . " WHERE producerId =" . $ProducerId;
    $result = @mysqli_query($Connect, $my_query);
    $result2 = @mysqli_query($Connect, $my_query2);

    if ($result) {
        $data_response['projects'] = array();
        $data_response['success'] = 1;

        while ($row = @mysqli_fetch_array($result)) {
            $project = array();
            $project['id'] = $row['ID'];
            $project['projectName'] = $row['projectName'];
            $project['projectIntro'] = $row['projectIntro'];
            $project['producerId'] = $row['producerId'];
            $project['date'] = $row['date'];
            array_push($data_response['projects'], $project);
        }
        if ($result2) {
            while ($row2 = @mysqli_fetch_array($result2)) {
                $message['id'] = $row2['ID'];
                $message['link'] = $row2['address'];
                $message['message_description'] = $row2['description'];
                array_push($data_response['messages'], $message);
            }
        } else {
            $data_response['message'] = "no message";
        }

    } else {
        $data_response['success'] = 0;
        $data_response['error_message'] = "no data";
    }
} else {
    $data_response['Error'] = "producer_id ?";
}

echo json_encode(@$data_response, JSON_PRETTY_PRINT);

mysqli_close($Connect);
?>
