<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "users";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['user'], $_GET['pass'])) {
    $userName = $_GET['user'];
    $password = $_GET['pass'];

    $query1 = "SELECT username FROM " . $TABLE_NAME . " WHERE username = '" . $userName . "'";
    $result1 = mysqli_query($Connect, $query1);
    if (!$result1->fetch_assoc() > 0) {
        $data_response['success'] = 0;
        $data_response['message'] = "can not find this user";
    } else {
        $query2 = "SELECT username, password FROM " . $TABLE_NAME . " WHERE password= '" . $password . "'"
            . " AND username = '" . $userName . "'";
        $result2 = mysqli_query($Connect,$query2);

        if ($result2->num_rows > 0) {
            $data_response['success'] = 1;
            $data_response['message'] = "Login Successful !";
        } else {
            $data_response['success'] = 0;
            $data_response['message'] = "the username or password incorrect !";
        }
    }


} else {
    $data_response['success'] = 0;
    echo "Error: Check Imported Data -> 'user, pass'";
    $data_response['message'] = "Error: Check Imported Data";
}
echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
mysqli_close($Connect);
