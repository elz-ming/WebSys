<?php

// Establish database connection
include "connectDB.php";

$table = isset($_GET['table']) ? $_GET['table'] : '';

switch($table) {
    case 'user':
        $query = "
            SELECT id, 
                    first_name AS `First Name`,
                    last_name AS `Last Name`, 
                    email AS `Email`, 
                    created_at AS `Creation Date`,
                    updated_at AS `Last Login`,
                    admin AS `isAdmin`, 
                    verified AS `isVerified`,
                    image_path AS `Image Path` 
            FROM user";
        break;
    case 'blog':
        $query = "
            SELECT id, 
                    title AS `Title`,
                    subtitle AS `Subtitle`, 
                    category AS `Category`, 
                    country AS `Country`,
                    image_path AS `Image Path` 
            FROM blog";
        break;
    case 'package':
        $query = "
            SELECT id, 
                    pname AS `Package Name`,
                    content AS `Content`, 
                    destination AS `Destination`, 
                    duration AS `Duration`,
                    price AS `Price`,
                    image_path AS `Image Path` 
            FROM package";
        break;
    default:
        echo 'Table not specified or unknown table.';
        exit;
}

$result = $conn->query($query);

if(!$result) {
    echo "Error fetching data: " . $conn->error;
    exit;
}

// Add button
echo "<button id='add-btn' class='add-row-btn'>Add</button>";

// Start table
echo "<table data-table=" . $table .">";
// Dynamically generate headers based on fetched columns
$columns = array_keys($result->fetch_assoc());
echo "<tr>";
echo "<th class='actions-cell'>Actions</th>";
foreach($columns as $column) {
    echo "<th class='header'>" . $column . "</th>";
}
echo "</tr>";

// Reset pointer to the first result
$result->data_seek(0);

// Populate table rows
while($row = $result->fetch_assoc()) {
    echo "<tr data-id=". $row['id']. ">";
    // Actions cell
    echo "<td class='actions-cell'>";
    echo  "<button class='edit-btn' data-id=" . $row['id'] . " data-table=" . $table . ">EDIT</button>";
    echo  "<button class='delete-btn'  data-id=" . $row['id'] . " data-table=" . $table . ">DELETE</button>";
    echo "</td>";
    foreach($row as $cell) {
        echo "<td>" . $cell . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Close database connection if it's no longer needed
$conn->close();
?>