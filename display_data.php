<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-top: 20px;
    }

    form {
        margin-bottom: 20px;
        text-align: center;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    form:not(:last-child) {
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
        margin-bottom: 8px;
    }

    select,
    input {
        padding: 8px;
        margin: 0 10px 10px 0;
        width: 200px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .table-container {
        overflow-x: auto;
        width: 80%; 
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    @media (max-width: 600px) {
        .table-container {
            width: 100%;
            overflow-x: auto;
            margin: 20px 0; 
        }

        form {
            flex-direction: column;
            align-items: flex-start;
        }

        select,
        input {
            width: 100%;
            margin: 0 0 10px 0;
        }
    }
</style>

</head>

<body>
<?php
// display_data.php

session_start();

if (!isset($_SESSION['password_verified']) || $_SESSION['password_verified'] !== true) {
    // Redirect to the password entry page if not verified
    header("Location: out.html");
    exit();
}

// ... rest of your code ...
?>

    <h2>GLOWTICS TECHNOLOGY</h2>

   
    <!-- form for email,anme and phone number -->
    <form method="post">
        <label for="filter">Select Filter Criteria: </label>
        <select id="filter" name="filter" required>
            <option value="email">Email</option>
            <option value="name">Name</option>
            <option value="phone">Phone Number</option>
        </select>
        <label for="value">Enter Value: </label>
        <input type="text" id="value" name="value" required>
        <input type="submit" value="Submit">
    </form>

    
    <!-- submission date form -->
    <form method="post">
        <label for="submission_date">Enter Submission Date: </label>
        <input type="date" id="submission_date" name="submission_date" required>
        <input type="submit" value="Submit">
    </form>

    <!-- form for service selected -->
    <form method="post">
        <label for="options">Select Option: </label>
        <select id="options" name="options" required>
            <option value="GST">GST</option>
            <option value="INCOME TAX">Income Tax</option>
            <option value="LICENSE">License</option>
            <option value="INSURANCE">Insurance</option>
            <option value="TAX PLANNING">Tax Planning</option>
            <option value="INVESTMENT PLANNING">Investment Planning</option>
            <option value="TRAVEL">Travel</option>
            <option value="FINTECH">Fintech</option>
        </select>
        <input type="submit" value="Submit">
    </form>

    <!-- Table Display Section -->
    <div class="table-container">
        <?php
      
        $servername = "localhost:3325";
        $username = "root";
        $password = "";
        $database = "glow";
       
        $conn = new mysqli($servername, $username, $password, $database);

       
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    //    form for email etc backend
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["filter"]) && isset($_POST["value"])) {
            
            $filter = $_POST["filter"];
            $submitted_value = $_POST["value"];

           
            $sql = "SELECT * FROM detail WHERE $filter = '$submitted_value'";
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Options</th>
                        <th>Feedback</th>
                        <th>Submission Date</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['options']}</td>
                        <td>{$row['feedback']}</td>
                        <td>{$row['submission_date']}</td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "No records found for the specified filter criteria and value.";
            }
        }

      
        // check submission date
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submission_date"])) {
            
            $submitted_date = $_POST["submission_date"];

            
            $sql = "SELECT * FROM detail WHERE DATE(submission_date) = '$submitted_date'";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Options</th>
                        <th>Feedback</th>
                        <th>Submission Date</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['options']}</td>
                        <td>{$row['feedback']}</td>
                        <td>{$row['submission_date']}</td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "No records found for the specified submission date.";
            }
        }

        // check for service opted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["options"])) {
           
            $submitted_option = $_POST["options"];

            
            $sql = "SELECT * FROM detail WHERE options = '$submitted_option'";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
               
                if ($result->num_rows > 0) {
                    echo "<table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Options</th>
                            <th>Feedback</th>
                            <th>Submission Date</th>
                        </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['dob']}</td>
                            <td>{$row['options']}</td>
                            <td>{$row['feedback']}</td>
                            <td>{$row['submission_date']}</td>
                        </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No records found for the specified option.";
                }
            }
        }

        
        $conn->close();
        ?>
    </div>
</body>

</html>
