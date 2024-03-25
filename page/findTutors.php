<?php
include "../common/header.html";
include "../common/navbar.php";
include "../common/OOP.php";

$allQueryFunction = new AllQueryFunction();

$result = $allQueryFunction->findAllTeacher();
$requesterEmail = $_SESSION['userEmail'];
// echo $requesterEmail;

// handle interested button

if (isset($_POST['interested'])) {

    // $role = $_SESSION['userRole'];

    $advertiseID = $_POST['advertiseID'];
    $publisherEmail = $_POST['publisherEmail'];

//     echo $publisherEmail . $advertiseID . $requesterEmail;

        $result =
        $allQueryFunction->insertIntoApply(
            $publisherEmail,
            $advertiseID,
            $requesterEmail
        );

        if ($result) {
            echo '<script>alert("Request send  successfully!");</script>';
            header('location:../page/findTutors.php');

        } else {
            $error = "insert is not success.";
        }
}

?>
<div class="  bg-blue-100 pb-10">
  <p class="text-center text-4xl font-bold pt-6">Our best teacher</p>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10">
    <?php
if (mysqli_num_rows($result) != 0) {

    // echo  mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        // Process and display the data
        // echo "<br>" . $row['password'] . "<br>";
        ?>
        <div class="card card-side bg-base-100 shadow-xl">
          <figure><img src="../person.jpg" alt="Movie" class="h-40 w-60 ml-3 rounded-md " /></figure>
          <div class="card-body">
            <h2 class="card-title"><?php echo $row['name'] ?></h2>
            <p><span class="font-semibold text-lg">From: </span> <?php echo $row['institution'] ?></p>
            <p><span class="font-semibold text-lg">Experience: </span><?php echo $row['experience'] ?> years</p>
            <p><span class="font-semibold text-lg">Subject: </span><?php echo $row['subject'] ?></p>
            <p><span class="font-semibold text-lg">weekly: </span><?php echo $row['weekly'] ?> day</p>
            <p><span class="font-semibold text-lg">Hour: </span><?php echo $row['hour'] ?></p>
            <p><span class="font-semibold text-lg">Type: </span><?php echo $row['tuition_type'] ?></p>
            <p><span class="font-semibold text-lg">Salary: </span><?php echo $row['salary'] ?> TK</p>


            <form method="post">

              <?php
if ($allQueryFunction->ifAlreadyRequest($requesterEmail, $row['advertise_id'])) {?>
                <div class="card-actions justify-end">
                  <input type="hidden" name="advertiseID" id="interestedIdInput" value="<?php echo $row['advertise_id'] ?>">

                  <button class="btn bg-blue-500  " disabled id="interested" data-specific-id="<?php echo $row['advertise_id'] ?>" name="interested">Pending..</button>
                </div>

              <?php
} else {?>
                <div class="card-actions justify-end">
                  <input type="hidden" name="advertiseID" id="interestedIdInput" value="<?php echo $row['advertise_id'] ?>">
<input type="hidden" name="publisherEmail" id="publisherEmail" value="<?php echo $row['email'] ?>">
                  <button class="btn bg-blue-500  " id="interested" data-specific-id="<?php echo $row['advertise_id'] ?>" name="interested" type="submit">Interested</button>
                </div>
              <?php }
        ?>

            </form>

            <div class="card-actions justify-end">
              <button class="btn bg-blue-500 redirectButton" data-specific-id="<?php echo $row['student_id'] ?>">View Details</button>
            </div>
          </div>
        </div>
    <?php

    }
} else {
    echo "No teacher available right now.";
}

?>
  </div>
</div>
<?php
include "../common/footer.php";
?>

<script type="">

  $(document).ready(function() {
      $('.redirectButton').click(function() {
        // Get the specific ID from the data attribute
        var specificId = $(this).data('specific-id');
        // console.log(specificId);
        // console.log("clocked");
        // Redirect to another page with the specific ID
        window.location.href = 'singleInfo.php?id=' + specificId;
      });
    });
</script>

<?php
include "../common/footer.html"

?>