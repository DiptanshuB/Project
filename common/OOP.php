<?php

class Connection
{
    public $host = "localhost";//127.0.0.1
    public $user = "root";
    public $password = "";
    public $db_name = "test";
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

class AllQueryFunction extends Connection
{
    // add new user
    public function addUser($name, $email, $password, $role, $phone, $institution, $address, $session, $experience, $status, $result,$file_name)
    {
        $sql = "INSERT INTO `Students`(`name`, `email`, `password`, `phone`, `role`, `institution`, `session`, `result`, `experience`, `address`, `status`, `photo`, `feedback`, `mobile_banking_number`) VALUES ('$name','$email','$password','$phone','$role','$institution','$session','$result','$experience','$address','$status','$file_name','','')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    // find user

    public function findUser($email, $ID)
    {

        if ($email && $ID) {
            // echo "botj";
        } else if ($ID) {
            $sql = "SELECT * FROM Students WHERE student_id = '$ID'";
        } else if ($email) {
            $sql = "SELECT * FROM Students WHERE email = '$email'";

        }

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }
    // find user

    public function check($email, $ID)
    {
        if ($email && $ID) {
            echo "botj";
        } else if ($ID) {
            echo "ID";
        } else if ($email) {
            echo "mail";
        }

    }

    // find all teacher
    public function findAllTeacher()
    {
        $sql = "SELECT * FROM Students JOIN Advertise ON Students.email = Advertise.email AND Advertise.role='teacher' AND Advertise.status='available' AND Advertise.admin_approval='approved'";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // find all student
    public function findAllStudent()
    {
        $sql = "SELECT * FROM Students JOIN Advertise ON Students.email = Advertise.email AND Advertise.role='student' AND Advertise.status='available' AND Advertise.admin_approval='approved'";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // insert advertise table
    public function advertise(
        $email,
        $role,
        $subject,
        $weekly,
        $salary,
        $type,
        $hour,
        $description,
        $status
        
    ) {
        // echo  $email . " " . $role . " " . $subject . " " . $weekly . " " . $type . " " . $hour . " " . $salary . " " . $status . " " . $description;

        $sql = "INSERT INTO `Advertise`(`email`, `role`, `subject`, `weekly`, `salary`, `tuition_type`, `status`, `hour`, `short_description`,`admin_approval`) VALUES ('$email','$role','$subject','$weekly','$salary','$type','$status','$hour','$description','')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    // insert into apply table
    public function
    insertIntoApply(
        $publisherEmail,
        $advertiseID,
        $requesterEmail
    ) {
        // echo   $publisherEmail.
        // $advertiseID.
        // $requesterEmail;

        $sql = "INSERT INTO `Apply`(`publisher_email`, `requester_email`, `advertise_id`) VALUES ('$publisherEmail','$requesterEmail','$advertiseID')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    // find all my published advertise / gig

    public function myAdvertise($email)
    {
        $sql = "SELECT * FROM Advertise WHERE email='$email'";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // find all my gig

    public function responseToMyAdvertise($email)
    {
        $sql = "SELECT * FROM Advertise JOIN Apply ON Advertise.email='$email' AND Apply.publisher_email='$email' AND Advertise.advertise_id=Apply.advertise_id ORDER BY Advertise.subject";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // check if a person send request already

    public function ifAlreadyRequest($email, $id)
    {
        $sql = "SELECT requester_email,advertise_id FROM `Apply` WHERE requester_email='$email' AND advertise_id='$id'";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) != 0) {
                return $result;
            }

        } else {
            return 0;
        }
    }

    // ----------update a single column value

    public function updateSingleValue($table, $updatedColumn, $value, $field, $fieldValue)
    {
        $sql = "UPDATE `$table`
SET `$updatedColumn` = '$value'
WHERE `$field` =  '$fieldValue'";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // ----------delete a single column value

    public function deleteSingleValue($table, $field, $fieldValue)
    {
        $sql = "DELETE FROM `$table`
WHERE $field = $fieldValue";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

    // insert teaching table

    public function acceptRequest($teacherID, $studentID, $teachingSubject, $advertiseID, $startDate)
    {

        $sql = "INSERT INTO `Teaching`(`teacher_id`, `student_id`, `subject`, `advertise_id`, `start_date`, `finish_date`, `student_rating`, `student_feedback`, `teacher_rating`, `teacher_feedback`) VALUES ('$teacherID','$studentID','$teachingSubject','$advertiseID','$startDate','','0.0','','0.0','')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
    // my current teaching from teaching table

    public function myCurrentTeaching($user_type_id,$userID)
    {

        $sql = "SELECT * FROM `Teaching` WHERE $user_type_id='$userID'";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
    // fetch a single value

    public function fetchSingleValue($tableName, $rowName, $searchField, $searchValue)
    {
        // echo $tableName . $rowName . $searchField . $searchValue;

        $sql = "SELECT $rowName FROM `$tableName` WHERE $searchField='$searchValue'";
        // echo $sql;
        $result = mysqli_query($this->conn, $sql);

        if ($result) {

            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $targetValue = $row[$rowName];
                   return $targetValue;
                }
            }

            return 0;
        } else {
            return 0;
        }
    }

        // ----------update teaching table for teacher click complete

    public function teacherClickComplete($teaching_id,$finish_date,$student_rating,$student_feedback)
    {
        $sql = "UPDATE `Teaching` SET `finish_date`='$finish_date',`student_rating`='$student_rating',`student_feedback`='$student_feedback'
WHERE `teaching_id` =  '$teaching_id'";

// echo $sql.$date . $teaching_id . $student_feedback . $student_rating;

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }
        // ----------update teaching table for student click complete

    public function studentClickComplete($teaching_id,$finish_date,$teacher_rating,$teacher_feedback)
    {
        $sql = "UPDATE `Teaching` SET `finish_date`='$finish_date',`teacher_rating`='$teacher_rating',`teacher_feedback`='$teacher_feedback'
WHERE `teaching_id` =  '$teaching_id'";

// echo $sql.$date . $teaching_id . $student_feedback . $student_rating;

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

        // ----------all teacher request

    public function allTeacherRequest()
    {
        $sql = "SELECT * FROM `Advertise` WHERE `role`='teacher' AND `admin_approval`=''";


        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }
        // ----------all student request

    public function allStudentRequest()
    {
        $sql = "SELECT * FROM `Advertise` WHERE `role`='student' AND `admin_approval`=''";


        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            return $result;
        } else {
            return 0;
        }
    }

}
