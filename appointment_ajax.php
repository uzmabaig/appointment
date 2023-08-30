<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment_form</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-4">

            <div class="col-md-8 offset-2" style="background-color:grey">
                <form action="#" method="POST" enctype="multipart/form-data" id="form">
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
        // $("#image").change(function(event){
        //     var image = event.target.files[0].name
        //     alert(image);

        // });

  
      $('#form').on('submit', function (e) {
             e.preventDefault();

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var appointment_date = $("input[name=appointment_date]:checked").val();
            var date_of_birth = $('#date_of_birth').val();

            savedata(firstname,lastname,email,phone,appointment_date,date_of_birth,image);
        });
            function savedata(firstname,lastname,email,phone,appointment_date,date_of_birth,image){
        $.ajax({
                type: "POST",
                url: "http://localhost/appointment/appointment_api.php",
                data: {
                    'firstname': firstname,
                    'lastname': lastname,
                    'email': email,
                    'phone': phone,
                    'date_of_birth': date_of_birth,
                    'appointment_date': appointment_date,
                    'image': image
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
        });

 
</script>





</html>