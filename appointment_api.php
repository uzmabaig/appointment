<?php
include 'model/Patient.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$patient = new Patient();
$uploadfile = 'no image';
$errors = [];
$data = $_POST;

if (!isset($data['firstname']) || $data['firstname'] == '' || !preg_match('/[a-zA-Z ]/', $data['firstname'])) {
    $errors['firstname'] = "Please enter your firstname";
}
if (!isset($data['lastname']) || $data['lastname'] == '' || !preg_match('/[a-zA-Z ]/', $data['lastname'])) {
    $errors['lastname'] = "Please enter your lastname";
}
if (!isset($data['email']) || $data['email'] == '') {
    $errors['email'] =  'Please enter your email';
}
if (!isset($data['phone']) || $data['phone'] == "") {
    $errors['phone'] = 'Please enter your contact/phone number';
}
if (!isset($data['appointment_date']) || $data['appointment_date'] == "") {
    $errors['appointment_date'] = 'Please select one date for your appointment';
}

if (!isset($data['date_of_birth']) || $data['date_of_birth'] == '') {
    $errors['date_of_birth'] = 'Please enter your date-of-birth';
}



if (isset($_FILES['image']['name'])) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    $file_ext = strtolower(explode('.', $file_name)[1]);
    $extensions = array("jpeg", "jpg", "png");


if (empty($errors)) {
    $name = time(); // set with time
    $location = 'image/';
    $uploadfile = $location . $name . basename($file_name);
    move_uploaded_file($file_tmp, $uploadfile);
}
}

if(!empty($errors)){
    http_response_code(403);
    echo json_encode($errors);
    return false;
    }

  $data['image'] = $uploadfile;
  $data['date']= date('y-m-d H:i:s');
  $add_patients= $patient->add($data);

if($add_patients === true){
  http_response_code(200);
  echo json_encode(['result' => 'Successfully Created']);
  }

 }else{
    http_response_code(400);
    echo json_encode(['result' => 'Request Type Error']);
 }

 ?>
