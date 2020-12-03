<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once 'database.php';
include_once 'user.php';
  
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$user = new User($db);
  
// query users
$stmt = $user->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if ($num > 0) {
  
    // products array
    $users_arr=array();
    $users_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $user = array(
            "id" => $id,
            "name" => $name,
            "created" => $created
        );
  
        array_push($users_arr["records"], $user);
    }
  
    http_response_code(200);
  
    echo json_encode($users_arr);
} else {
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No users found.")
    );
}

