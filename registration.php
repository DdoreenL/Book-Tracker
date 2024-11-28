<?php

include 'connect.php';

$db = Database::getInstance();
$conn = $db->getConnection();

$sql = "SELECT * FROM tbl_users";

try {
    $stmt = $conn->prepare ($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    } 
}catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
</head>
<body>
    <form action="backend.php" method="post" id="registration">
        <div class="title"><h2>Register</h2></div>

            <label for="ID">ID:</label>
                <input type="text" name="ID" id="id"><br><br>

            <label for="username">Username:</label>
                <input type="text" name="Username" id="Username"><br><br>

            <label for="fullname">Name:</label>
                <input type="text" name="Name" id="Name"><br><br>

            <label for="phone">Phone No.:</label>
                <input type="text" name="PhoneNo" id="PhoneNo"><br><br>

            <label for="email">Email:</label>
                <input type="text" name="Email" id="Email"><br><br>

            <label for="password">Password:</label>
                <input type="text" name="Password" id="Password"><br><br>

            <label for="Confirm">Confirm:</label>
                <input type="text" name="confirm" id="confirm"><br><br>

            <button type="submit">Submit</button>

        <script>
            document.getElementById('registration').addEventListener('submit', function(event) {
                event.preventDefault();
                
                var username= document.getElementById('Username').value;
                var name= document.getElementById('Name').value;
                var phone= document.getElementById('PhoneNo').value;
                var email= document.getElementById('Email').value;
                var password= document.getElementById('Password').value;
                var confirm= document.getElementById('confirm').value;
                var specialcharacter=/[!@#$%^&*()_<>?:""=+]/;

                if (username === "" || name === "" || phone === "" || email === "" || password === "" || confirm ==="" ){
                    alert("All field are required!");
                }
                else if(password !== confirm) {
                    alert("Unmatched password!");
                }
                else if (phone.length !== 11){
                    alert("Phone number must be exactly 11 characters.");
                }
                else if (password.length < 10){
                    alert("Password must be exactly 10 characters.");
                }
                else if (!specialcharacter.test(password)){
                    alert("Include at least one special character.");
                }
                else {                    
                    alert("Nice one! Finally nagbalin metlangen!");
                    this.submit();
                    // <a href="main.php"></a>
                }
            });
        </script>

    </form>

</body>
</html>