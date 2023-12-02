<?php
session_start();

$host = 'localhost';
$username = 'root'; //depends on system
$password = '';
$dbname = 'dolphin_crm';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$filtered = $_GET["filter"];

if($filtered == "All"){
    echo all_contacts($conn);
}

else if ($filtered == "SalesLead"){
    $lookup = "Sales Lead";
    echo only_type($conn, $lookup);
}

else if ($filtered == "Support"){
    $lookup = "Support";
    echo only_type($conn, $lookup);
}

else if ($filtered == "Assigned"){
    echo assigned_to($conn);
}


function all_contacts($conn){
    $stmt = $conn->query("SELECT * FROM Contacts");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Company</th>";
    echo "<th>Type</th>";
    echo "<th></th>";
    echo "</tr>";

    foreach($results as $row){
        $name = $row["title"]. ' ' . $row["firstname"]. ' '.$row["lastname"];
        echo "<tr>";
        echo "<td>".$name."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["company"]."</td>";
        if ($row["type"] == "Sales Lead"){
            echo "<td class='sales_type'>".$row["type"]."</td>";
        }
        else if($row["type"] == "Support"){
            echo "<td class='support_type'>".$row["type"]."</td>";
        }

        echo "<td>"."<a href='#'>View</a>"."</td>"; #should go to the implementation of view full contact details
        echo "</tr>";
    }

    echo "</table>";

}

// displays one one type of contract (Sales Lead or Support)
function only_type($conn, $lookup){
    $stmt = $conn->query("SELECT * FROM Contacts WHERE type LIKE '%$lookup%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Company</th>";
    echo "<th>Type</th>";
    echo "<th></th>";
    echo "</tr>";

    foreach($results as $row){
        $name = $row["title"]. ' ' . $row["firstname"]. ' '.$row["lastname"];
        echo "<tr>";
        echo "<td>".$name."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["company"]."</td>";
        if ($lookup == "Sales Lead"){
            echo "<td class='sales_type'>".$row["type"]."</td>";
        }
        else if($lookup == "Support"){
            echo "<td class='support_type'>".$row["type"]."</td>";
        }
        echo "<td>"."<a href='#'>View</a>"."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function assigned_to($conn){
    $current_id = $_SESSION['id'];
    
    $stmt = $conn->query("SELECT * FROM Contacts WHERE assigned_to='$current_id'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Company</th>";
    echo "<th>Type</th>";
    echo "<th></th>";
    echo "</tr>";

    foreach($results as $row){
        $name = $row["title"]. ' ' . $row["firstname"]. ' '.$row["lastname"];
        echo "<tr>";
        echo "<td>".$name."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["company"]."</td>";
        
        if ($row["type"] == "Sales Lead"){
            echo "<td class='sales_type'>".$row["type"]."</td>";
        }
        else if($row["type"] == "Support"){
            echo "<td class='support_type'>".$row["type"]."</td>";
        }
        echo "<td>"."<a href='#'>View</a>"."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

?>