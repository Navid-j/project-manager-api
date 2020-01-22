<?php
header("Content-type: application/json");
require_once "Config.php";
$TABLE_NAME = "projects";
$TABLE_NAME_USER = "users";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8"); // UTF-8 :) After Several Hours
$my_query = "SELECT * FROM " . $TABLE_NAME;
ini_set('display_errors', 1);

$result = @mysqli_query($Connect, $my_query);
if ($result) {
    $data_response['projects'] = array();
    $data_response['success'] = 1;

    while ($row = @mysqli_fetch_array($result)) {
        $project = array();
        $project['id'] = $row['ID'];
        $project['projectName'] = $row['projectName'];
        $project['projectIntro'] = $row['projectIntro'];
        $nameObj = mysqli_fetch_array(mysqli_query($Connect
            , "SELECT CONCAT(firstName , ' ' , lastName) as name FROM " . $TABLE_NAME_USER
            . " WHERE personnelCode = " . $row['producerId']));
        $project['producerId'] = $nameObj['name'];;
        $project['date'] = $row['date'];

        array_push($data_response['projects'], $project);

    }


} else {
    $data_response['success'] = 0;
    $data_response['message'] = "no data";
}


echo json_encode(@$data_response, JSON_PRETTY_PRINT);

mysqli_close($Connect);
?>
