<?php

// mail(to,subject,message,header)

$to = 'uzmaa.ba@gmail.com';
$subject = 'test email';
$message = 'Hello! how can i can help you mam?';
$from = 'anwar@gmail.com';
$header = "From:$from";

mail($to, $subject, $message, $header);
echo "Mail Sent";




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Email</title>
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
            <div class="col-md-8 offset-2" style="background-color:lightblue">
                <form action="email.php" method="POST" enctype="multipart/form-data" id="form">

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-12">
                            <label for="subject">Subject:</label>
                            <input type="subject" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="col-md-12">
                            <label for="textarea">Message:</label>
                            <textarea class="form-control" type="text" id="message" name="message" rows="5"></textarea>
                        </div>
                        <br><br>
                        <div class="row col-md-6 mt_4 mb-4 offset-3">
                            <input type="submit" class="btn btn-primary" value='submit' name='emailsubmit' id="submit">
                        </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>