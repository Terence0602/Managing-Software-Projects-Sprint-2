<?php
if (isset($_POST['export_csv']) && isset($_GET['buyer']) && isset($_GET['item']) && isset($_GET['sales_id'])) {
    $buyer = $_GET['buyer'];
    $item = $_GET['item'];
    $sales_id = $_GET['sales_id'];

    $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM sales WHERE SalesBuyerName LIKE '%$buyer%' AND SalesItem LIKE '%$item%' AND SalesID LIKE '%$sales_id%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exported_sales.csv"');

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
