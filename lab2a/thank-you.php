<?php

require "helpers/helper-functions.php";

session_start();

// $contact_number = $_POST['contact_number'];

$fullname = $_POST['fullname'];
$birthdate = $_POST['birthdate'];
$timestamp = strtotime($birthdate);
$newbirthdate = date("F j, Y", $timestamp);
# Encrypt the password first before saving it to the Session Variables
$age = date_diff(date_create($birthdate), date_create('now'))->y;
$contact_number = $_POST['contact_number'];
$sex = $_POST['sex'];
$program = $_POST['program'];
$address = $_POST['address'];
$email = $_POST['email'];
// $program = $_POST['program'];
$password = $_POST['password'];
$agree = $_POST['agree'];



// $_SESSION['contact_number'] = $contact_number;
$_SESSION['fullname'] = $fullname;
$_SESSION['birthdate'] = $birthdate;
$_SESSION['age'] = $age;
$_SESSION['contact_number'] = $contact_number;
$_SESSION['sex'] = $sex;
$_SESSION['program'] = $program;
$_SESSION['address'] = $address;
$_SESSION['email'] = $email;
// $_SESSION['program'] = $program;
$_SESSION['password'] = sha1($password);
$_SESSION['agree'] = $agree;


$form_data = $_SESSION;

dump_session();

$csv_file = '../lab2b/registrations.csv';

// Open the file in append mode
$file = fopen($csv_file, 'a');

// Check if the file was opened successfully
if ($file === false) {
    die('Error opening the file.');
}

// Write the session data to the CSV file
fputcsv($file, [
    $form_data['fullname'],
    $form_data['birthdate'],
    $form_data['age'],
    $form_data['contact_number'],
    $form_data['sex'],
    $form_data['program'],
    $form_data['address'],
    $form_data['email'],
    $form_data['password'],
    $form_data['agree']
]);

// Close the file
fclose($file);


session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Thank You Page
        </h1>
      </div>
      <div class="p-section--shallow">
      
        <table aria-label="Session Data">
            <thead>
                <tr>
                    <th></th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($form_data as $key => $val):
            ?>
                <tr>
                    <th><?php echo $key; ?></th>
                    <td>
                      <?php echo $val; ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
      

      </div>
    </div>
  </div>
</section>

</body>
</html>