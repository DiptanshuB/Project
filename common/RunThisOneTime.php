<?php
$servername = "localhost"; //127.0.0.1
$username = "root";
$password = "";
// $databaseName = "GeniusGuide";
$databaseName = "test";

$conn = mysqli_connect($servername, $username, $password, $databaseName);


// create Students table


$studentTable="CREATE TABLE IF NOT EXISTS Students (
  student_id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  email varchar(200) NOT NULL,
  password varchar(30) NOT NULL,
  phone varchar(200) NOT NULL,
  role varchar(30) NOT NULL,
  institution varchar(200) NOT NULL,
  session varchar(200) NOT NULL,
  result varchar(200) NOT NULL,
  experience varchar(200) NOT NULL,
  address varchar(200) NOT NULL,
  status varchar(200) NOT NULL,
  photo varchar(200) NOT NULL,
  feedback varchar(200) NOT NULL,
  mobile_banking_number varchar(200) NOT NULL,
  PRIMARY KEY (student_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


if ($conn->query($studentTable) === true) {
    echo "Student Table created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// create Advertise table


$studentTable="CREATE TABLE IF NOT EXISTS Advertise (
  advertise_id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(100) NOT NULL,
  role varchar(20) NOT NULL,
  subject varchar(200) NOT NULL,
  weekly varchar(20) NOT NULL,
  salary varchar(20) NOT NULL,
  tuition_type varchar(20) NOT NULL,
  status varchar(20) NOT NULL,
  hour varchar(20) NOT NULL,
  short_description varchar(200) NOT NULL,
  admin_approval varchar(100) NOT NULL,
  PRIMARY KEY (advertise_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


if ($conn->query($studentTable) === true) {
    echo "Aadvertise Table created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}


// create Apply table


$studentTable="CREATE TABLE IF NOT EXISTS Apply (
  apply_id int(11) NOT NULL AUTO_INCREMENT,
  publisher_email varchar(200) NOT NULL,
  requester_email varchar(200) NOT NULL,
  advertise_id int(11) NOT NULL,
  PRIMARY KEY (apply_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";


if ($conn->query($studentTable) === true) {
    echo "Apply Table created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// create Teaching table


$studentTable="CREATE TABLE IF NOT EXISTS Teaching (
  teaching_id int(11) NOT NULL AUTO_INCREMENT,
  teacher_id int(11) NOT NULL,
  student_id int(11) NOT NULL,
  subject varchar(100) NOT NULL,
  advertise_id int(11) NOT NULL,
  start_date varchar(100) NOT NULL,
  finish_date varchar(100) NOT NULL,
  student_rating float NOT NULL,
  student_feedback varchar(500) NOT NULL,
  teacher_rating float NOT NULL,
  teacher_feedback varchar(500) NOT NULL,
  PRIMARY KEY (teaching_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


if ($conn->query($studentTable) === true) {
    echo "Teaching Table created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}


?>