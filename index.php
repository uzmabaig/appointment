<?php
include 'model/Patient.php';

$patient = new patient();
$msg = "";
$errors = array();
$uploadfile = 'no image';
if (isset($_POST['submit'])) {

    $data = $_POST;

    if (isset($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $file_ext = strtolower(explode('.', $file_name)[0]);
        $extensions = array("jpeg", "jpg", "png");
    }

    // Validation 

    if ($data['firstname'] == '' || !preg_match('/[a-zA-Z ]/', $data['firstname'])) {
        $errors['firstname'] = "Please enter your firstname";
    }
    if ($data['lastname'] == '' || !preg_match('/[a-zA-Z ]/', $data['lastname'])) {
        $errors['lastname'] = "Please enter your lastname";
    }
    if ($data['email'] == '') {
        $errors['email'] =  'Please enter your email';
    }
    if ($data['phone'] == "") {
        $errors['phone'] = "Please enter your correct phone number(000-0000-0000)";
    }
    if (!isset($data['appointment_date']) || $data['appointment_date'] == "") {
        $errors['appointment_date'] = 'Please select one date for your appointment';
    }

    if ($data['date_of_birth'] == '') {
        $errors['date_of_birth'] = 'Please enter your date-of-birth';
    }

    if (empty($errors)) {
        $name = time(); // set with time
        $location = 'image/';
        $uploadfile = $location . $name . basename($file_name);
        move_uploaded_file($file_tmp, $uploadfile);
    }
    if (empty($errors)) {
        $data = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $uploadfile,
            'appointment_date' => $data['appointment_date'],
            'date_of_birth' => $data['date_of_birth'],
            'date' => date('y-m-d H:i:s')
        ];

        $add_patients = $patient->add($data);
        $msg = '<div class="alert alert-success">Appointment Successfully Done!</div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Form</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

<body>
    <div class="container">
        <div class="row mt-4">
            <?php
            if ($msg !== "") { ?>
                <?= $msg ?>
            <?php } ?>
            <div class="col-md-8 offset-2" style="background-color:lightblue">
                <form action="index.php" method="POST" enctype="multipart/form-data" id="form">
                    <div class="col-md-8 offset-2 mt-4">
                        <?php
                        if (count($errors) > 0) {
                            echo '<div class="alert alert-danger"><ul>';
                            foreach ($errors as $error) {
                                echo "<li>{$error}</li>";
                            }
                            '</ul></div>';
                        } ?>
                    </div>
                    <div class="col-md-8 offset-2 mt-4">

                        <h2 class="text-center">Doctor Appointment Form</h2>
                        </hr>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                            <p class="text-danger" id="valid-firstname"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            <p class="text-danger" id="valid-lastname"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <p class="text-danger" id="valid-email"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Contact/Phone:</label>
                            <input type="number" class="form-control" id="phone" name="phone">
                            <p class="text-danger" id="valid-phone"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="birthdate">Date Of Birth:</label>
                            <input class="form-control" type="date" id="date_of_birth" name="date_of_birth">
                            <p class="text-danger" id="valid-birthdate"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="age">Age:</label>
                            <input class="form-control" type="number" id="age" name="age">
                            <p class="text-success" id="valid-age"></p>
                        </div>
                        <div class="col-md-12">
                            <label for="appointment_date">Select Appointment Date:</label>
                            <?php
                            $date = new \DateTime();
                            for ($i = 1; $i < 6; $i++) {
                                $date = $date->modify(modifier: '+1 day');
                                echo "</br>";
                                echo "<input id='appointment_date_{$i}' type='radio' value='{$date->format(format: 'Y-m-d')}' name='appointment_date'>";
                                echo "<lable for='appointment_date_{$i}'>{$date->format(format: 'Y-m-d')}</label>";
                            } ?>
                        </div>
                        <div class="col-md-12">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <p class="text-danger" id="valid-image"></p>
                        </div>
                        <div class="row col-md-6 mb-4 offset-3">
                            <input type="submit" class="btn btn-primary" value='submit' name='submit' id="submit">
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        $('#form').on('submit', function(e) {
            e.preventDefault();

            // Validate FullName
            var name = $('#firstname').val();
            var namep = '';
            if (name == "") {
                namep = "Please enter your firstname"
                $('#valid-firstname').text(namep);
            } else if (!Checklength(name, [5, 20]) || !validatealpha(name))
                namep = "invalid-name"
            $('#valid-firstname').text(namep);

            // Validate LastName
            var name01 = $('#lastname').val();
            var namep01 = '';
            if (name01 == "") {
                namep01 = "Please enter your lastname"
                $('#valid-lastname').text(namep01);
            } else if (!Checklength(name01, [5, 20]) || !validatealpha(name01))
                namep01 = "invalid-name"
            $('#valid-lastname').text(namep01);

            //  Validate Email
            var email = $('#email').val();
            var emailp = '';
            if (email == "") {
                emailp = "Please enter your email"
                $('#valid-email').text(emailp);
            } else if (!validateEmail(email))
                emailp = 'Please correct your email like example@example.com'
            $('#valid-email').text(emailp);

            //  Validate contact/phone
            var number = $('#phone').val();
            var Numberp = '';
            if (number == "") {
                Numberp = "Please enter your contact/phone number"
                $('#valid-phone').text(Numberp);
            } else if (!Checklength(number, [11, 25]))
                Numberp = "Please enter your correct phone number(000-0000-0000)"
            $('#valid-phone').text(Numberp);

            //    validate age/birthdate
            var birthdate = $('#date_of_birth').val();
            var age = $('#age').val();
            var charges = "";
            var agep = "";
            if (birthdate == "") {
                agep = "Please enter your date of birth"
                $('#valid-birthdate').text(agep);

                $('#date_of_birth').change(function() {
                    var dob = $(this).val();
                    var today = new Date();
                    var dobtodate = new Date(dob);
                    var age = today.getFullYear() - dobtodate.getFullYear();
                    if (age < 18) {
                        charges = "You will pay 25Euro"
                        $('#valid-age').text(charges);
                    } else {
                        charges = "You will pay 35Euro"
                        $('#valid-age').text(charges);
                    }
                    $('#age').val(age);
                });
            } else {
                $('#valid-birthdate').text("");
            }

            // Validate image
            var image = $('#image').val();
            var imagep = '';
            if (image == "") {
                imagep = "Please fill the image file"
                $('#valid-image').text(imagep);

            } else if (!Validatefilename(image)) {
                imagep = 'extension not allowed, please choose a JPEG or PNG file'
            } else {
                $('#valid-image').text(imagep);
            }

            $('#form').unbind().submit();

        });

        const validatealpha = (password) => {
            const re = new RegExp(/^[a-zA-Z]*$/);
            return re.test(password);
        };
        const Checklength = (str, length) => {
            if (str.length >= length[0] && str.length <= length[1])
                return true;
        };
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )
        };
      const Validatefilename = (filename) => {
            var imageReg = /[\/.](jpg|jpeg|png)$/i;
            return imageReg.test(filename);
        };

    });
</script>

</html>