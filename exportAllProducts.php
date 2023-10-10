<?php
$conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM product";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="all_product_records.csv"');

    $output = fopen('php://output', 'w');

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
} else {
    echo "No records found to export.";
}

$conn->close();
?>
