<?php
if (isset($_POST['export_csv']) && isset($_GET['fname']) && isset($_GET['lname'])) {
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];

    $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM member WHERE MemberFirstName LIKE '%$fname%' AND MemberLastName LIKE '%$lname%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exported_member.csv"');

        $output = fopen('php://output', 'w');

        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);
    } else {
        echo "No records found to export.";
    }

    $conn->close();
}
?>
