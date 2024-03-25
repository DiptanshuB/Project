<?php
include "../common/header.html";
include "../common/navbar.php";
include "../common/OOP.php";

$allQueryFunction = new AllQueryFunction();

// Retrieve the specific ID from the URL
$specificEmail = '';
$ID = isset($_GET['id']) ? $_GET['id'] : '';

// echo $ID;
$user = $allQueryFunction->findUser($specificEmail, $ID);

// Use the specific ID as needed in your page
?>
<?php
if (mysqli_num_rows($user) != 0) {

    // echo  mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($user)) {
        // Process and display the data
        // echo "<br>" . $row['password'] . "<br>";
        ?>
<div class="flex justify-center items-center flex-col">

<div><img src="../person.png" alt="" class="rounded-full"></div>
<div class="my-6">
<h2 class=" text-center font-semibold text-2xl"><?php echo $row['name'] ?></h2>
                <p><span class="font-semibold text-lg">From: </span>
<?php echo $row['institution'] ?></p>
                <p><span class="font-semibold text-lg">Address: </span>
<?php echo $row['address'] ?></p>

                <?php

        if ($row['role'] == 'student') {?>

                <p><span class="font-semibold text-lg">Class: </span>
<?php echo $row['session'] ?></p>
                <p><span class="font-semibold text-lg">Result: </span>
<?php echo $row['result'] ?></p>


                <?php } else if ($row['role'] == 'teacher') {?>
                <p><span class="font-semibold text-lg">Experience: </span>
<?php echo $row['experience'] ?> Years</p>

                <?php
}
        ?>
</div>

</div>

<?php

    }
} else {
    echo "No teacher available right now.";
}

?>

<?php
include "../common/footer.php";

include "../common/footer.html"

?>