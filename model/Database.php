<?php
class Database { 

    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = null;
    const PORT = 3306;
    const DATABASE_NAME = 'appointment';

    protected function connect(){

        // Create connection
        $conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // echo "Connected successfully";
        return $conn;

       }
       public function patient_data_save($data){
            
        $con = $this->connect();
        $sql = "INSERT into appointment_form values (null,'{$data['firstname']}','{$data['lastname']}','{$data['email']}','{$data['phone']}','{$data['image']}','{$data['appointment_date']}','{$data['date_of_birth']}','{$data['date']}')";
        $result = $con->query($sql);
        return $result;
        }


    }