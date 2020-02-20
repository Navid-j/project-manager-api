<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "users";

ini_set('display_errors', 1);

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

        $query = "SELECT personnelCode, firstName, lastName FROM " . $TABLE_NAME;
        $result = mysqli_query($Connect,$query);

        if ($result->fetch_assoc() > 0) {
            $data_response['users'] = array();
            $data_response['success'] = 1;
            while ($row = @mysqli_fetch_array($result)) {
                $user = array();
                $user['userName'] = $row['firstName'] . " " .  $row['lastName'];
                $user['producerId'] = $row['personnelCode'];
        
                array_push($data_response['users'], $user);
            }
        
        } else {
            $data_response['success'] = 0;
            $data_response['message'] = "no data";
        }
echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
mysqli_close($Connect);
?>