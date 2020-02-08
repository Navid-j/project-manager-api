<?php
header('Content-type: application/json; charset=utf-8');
require_once "Config.php";
$TABLE_NAME = "projects";

$Connect = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE_NAME);
mysqli_set_charset($Connect, "utf8");

if (isset($_GET['project_name'], $_GET['project_intro'], $_GET['personnel_code'])) {
    $projectName = $_GET['project_name'];
    $projectIntro = $_GET['project_intro'];
    $persCode = $_GET['personnel_code'];

    $my_query = "INSERT INTO " . $TABLE_NAME . " (projectName, projectIntro, producerId) 
            VALUES('$projectName', '$projectIntro', '$persCode')";

} else {
    echo "Error: Check Imported Data -> 'project_name, project_intro, personnel_code'";
    $data_response['success'] = 0;
}

if ($Connect->query($my_query) == true) {
    $data_response['success'] = 1;
    $data_response['message'] = "new Project Created . ";
} else {
    echo "Error: " . $my_query . $Connect->error;
    $data_response['success'] = 0;
}
echo json_encode($data_response, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
mysqli_close($Connect);
