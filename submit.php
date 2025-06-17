<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Basic info
    $groupScheme = $_POST["group_scheme"];
    $membershipNumber = $_POST["membership_number"];
    $sumAssured = $_POST["sum_assured"];
    $monthlyPremium = $_POST["monthly_premium"];

    // Principal Member
    $fullName = $_POST["full_name"];
    $dob = $_POST["dob"];
    $idNumber = $_POST["id_number"];
    $occupation = $_POST["occupation"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Next of Kin
    $nokName = $_POST["nok_name"];
    $nokID = $_POST["nok_id"];
    $nokPhone = $_POST["nok_phone"];
    $nokGender = $_POST["nok_gender"];

    // Start building message
    $message = "SUNREST MEMBERSHIP APPLICATION\n\n";

    $message .= "=== Group Scheme Info ===\n";
    $message .= "Group Scheme: $groupScheme\n";
    $message .= "Membership #: $membershipNumber\n";
    $message .= "Sum Assured: $sumAssured\n";
    $message .= "Monthly Premium: $monthlyPremium\n\n";

    $message .= "=== Principal Member ===\n";
    $message .= "Full Name: $fullName\n";
    $message .= "DOB: $dob\n";
    $message .= "ID Number: $idNumber\n";
    $message .= "Occupation: $occupation\n";
    $message .= "Address: $address\n";
    $message .= "Phone: $phone\n";
    $message .= "Email: $email\n\n";

    $message .= "=== Next of Kin ===\n";
    $message .= "Name: $nokName\n";
    $message .= "ID: $nokID\n";
    $message .= "Phone: $nokPhone\n";
    $message .= "Gender: $nokGender\n\n";

    $message .= "=== Covered Members ===\n";

    $members = ["p_", "spouse_", "child1_", "child2_", "child3_", "child4_", "b1_", "b2_", "b3_", "b4_", "b5_"];
    $labels = ["Principal", "Spouse", "Child 1", "Child 2", "Child 3", "Child 4", "Beneficiary 1", "Beneficiary 2", "Beneficiary 3", "Beneficiary 4", "Beneficiary 5"];

    for ($i = 0; $i < count($members); $i++) {
        $prefix = $members[$i];
        $message .= $labels[$i] . ":\n";
        $message .= "  Name: " . $_POST[$prefix . "name"] . " " . $_POST[$prefix . "surname"] . "\n";
        $message .= "  Gender: " . $_POST[$prefix . "gender"] . "\n";
        $message .= "  DOB: " . $_POST[$prefix . "dob"] . "\n";
        $message .= "  ID: " . $_POST[$prefix . "id"] . "\n";
        $message .= "  Premium: " . $_POST[$prefix . "premium"] . "\n\n";
    }

    // Send the email
    $to = "nsibare@gmail.com"; // <-- Replace with your email
    $subject = "New Membership Application - Sunrest Funeral";
    $headers = "From: no-reply@sunrest.co.zw\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    // Redirect to thank you page
    header("Location: thank-you.html");
    exit();
}
?>
