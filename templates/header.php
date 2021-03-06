<?php
  session_start();

  $sidebar = '';
  if (isset($_SESSION["loginID"])){
    require_once "../config.php";


    $login = $_SESSION["loginID"];

    if($login == "doctor") {
      $user = $_SESSION["user"];
      $query = "SELECT doctor.drFName, doctor.drLName, doctor.drSpecialty, department.deptName
       FROM doctor, department WHERE doctor.drID = '$user' AND doctor.deptID = department.deptID;";
      $responce = mysqli_query($dbc, $query);
      $row = mysqli_fetch_array($responce);
      echo '<div class="main-header"> <table> <tr class="profile-info"> <td>User: ' . $row["drFName"] . ' ' . $row["drLName"] .
      '</td> <td>User number: ' . $user . '</td> <td>Department: ' . $row["deptName"] . '</td> <td> Specialty: ' . $row["drSpecialty"]
       . '</td> </tr> </table> </div>';
       $sidebar = '<div class="sidebar">
       <a href="../patient/patient_list.php">Patients</a>
       <a href="../doctor/doctor_schedule.php">Schedule</a>
       <a href="../logout.php" class="logout-button">Logout</a>
       </div>';
    }
    elseif($login == "patient") {
      $mrn = $_SESSION['MRN'];
      $query = "SELECT patient.pFName, patient.pLName, patient.pMRN, doctor.drFName, doctor.drLName
       FROM doctor, patient WHERE '$mrn' = patient.pMRN AND patient.drID = doctor.drID;";
      $responce = mysqli_query($dbc, $query);
      $row = mysqli_fetch_array($responce);
      echo '<div class="main-header"> <table> <tr class="profile-info"> <td>MRN: ' . $mrn .
      '</td> <td>Patient Name: ' . $row['pFName'] . ' ' . $row['pLName'] .
      '</td> <td> Doctor\'s Name: ' . $row['drFName'] . ' ' . $row['drLName'] . '</td> </tr> </table> </div>';
      $sidebar = '<div class="sidebar">
      <a href="../patient/patient_data.php">Patient Info</a>
      <a href="./prescriptions.php">Prescriptions</a>
      <a href="../patient/appointments.php">Appointments</a>
      <a href="../logout.php" class="logout-button">Logout</a>
      </div>';
    }
    elseif($login == "reception") {
      $user = $_SESSION["user"];
      $query = "SELECT receptID, receptDept FROM reception WHERE reception.receptID = '$user';";
      $responce = mysqli_query($dbc, $query);
      $row = mysqli_fetch_array($responce);
      echo '<div class="main-header"> <table> <tr class="profile-info"> <td>User number: ' . $user . '</td> <td>Department: '
      . $row["receptDept"] . '</td> </tr> </table> </div>';
      $sidebar = '<div class="sidebar">
      <a href="../patient/patient_list.php">Patients</a>
      <a href="../patient/appointments.php">Appointments</a>
      <a href="../logout.php" class="logout-button">Logout</a>
      </div>';
    }
    echo '<div class="main-content-loggedin">';
  }
  else echo '
    <h1>Login Here</h1>
    <ul class="login-container">
      <li>
        <a href="doctor/doctor_login.php"><strong>Doctor Login</strong></a>
      </li>
      <li>
        <a href="patient/patient_login.php"><strong>Patient Login</strong></a>
      </li>
      <li>
        <a href="reception/reception_login.php"><strong>Reception Login</strong></a>
      </li>
    </ul> <div class="main-content-loggedout">';

  echo $sidebar;

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body style="background-color:rgb(51, 52, 53); color:white;">
  </body>

</html>
