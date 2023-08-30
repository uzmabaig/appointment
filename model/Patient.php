<?php

include "Database.php";

class Patient extends Database {
  public function add($data){
    return $this->patient_data_save($data);
      
  }

}


?>