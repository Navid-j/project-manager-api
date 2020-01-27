<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "users";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['first_name'], $_GET['last_name'], $_GET['personnel_code'],
    $_GET['phone_number'], $_GET['level'], $_GET['user'], $_GET['pass'])) {

    $firstName = $_GET['first_name'];
    $lastName = $_GET['last_name'];
    $persCode = $_GET['personnel_code'];
    $phoneNumber = $_GET['phone_number'];
    $level = $_GET['level'];
    $userName = $_GET['user'];
    $password = $_GET['pass'];

    $my_query = "INSERT INTO " . $TABLE_NAME . " (firstName, lastName, personnelCode, phoneNumber, level, username, password) 
            VALUES('$firstName', '$lastName', '$persCode', '$phoneNumber', '$level', '$userName', '$password')";

} else {
    echo "Error: Check Imported Data -> 'first_name, last_name, personnel_code, phone_number, level, user, pass'";
    echo " < br> Error: " . $my_query . mysqli_error($Connect);
    $data_response['success'] = 0;
}

if ($Connect->query($my_query) == true) {
    $data_response['success'] = 1;
    $data_response['message'] = "Register Completed . ";
} else {
    echo "Error: " . $my_query . $Connect->error;
    $data_response['success'] = 0;
}
echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
mysqli_close($Connect);
?>
