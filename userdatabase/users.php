<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>

<scri>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "college";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    $db_error = false;
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
        $db_error = true;
    }
    if (!$db_error) {
        $sql = "SELECT * FROM user_table    ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            ?>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Password</th>
                    <th>#</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo ($row["name"]); ?></td>
                        <td><?php echo ($row["email"]); ?></td>
                        <td><?php echo ($row["mobile"]); ?></td>
                        <td><?php echo ($row["password"]); ?></td>
                        <td>
                            <?php
                            // $parameters = "name=" . $row["name"] . "&email=" . $row["email"] . "&mobile=" . $row["mobile"] . "&password=" . $row["password"];
                
                            // $url = "update_form.php" . $parameters;          
                            $url = "update_form.php?id=" . $row["id"];
                            $delete_url = "delete_api.php?id=" . $row["id"];
                            ?>
                            <!-- <a href="<?php //echo ($url); ?>"><input type="button" value="Update"> </a> -->
                            <input type="button"
                                onclick="Update('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['mobile']; ?>', '<?php echo $row['password']; ?>')"
                                value="Update">
                            <!-- <input type="button" onclick="Update(<?php //echo ($row['id']); ?>)" value=Update> -->
                            <input type="button" onclick="Delete(<?php echo ($row['id']); ?>)" value="Delete">
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            echo "0 results";
        }
    }
    $conn->close();
    ?>
    <script>
        function Delete(id) {
            let parameters = "?id=" + id;
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                let result = this.responseText;
                result = JSON.parse(result);
                if (result.iderror != "") {
                    alert(result.iderror);
                }
                if (result.success != "") {
                    alert(result.success);
                    window.location.href = "";
                }
            }
            xhttp.open("GET", "http://localhost/userdatabase/delete_api.php" + parameters, true);
            xhttp.send();
        }
    </script>

    <form action="http://localhost/userdatabase/" method="get" id="my_form">
        <span id="close_form"></span>
        <div id=form_container>
            <div class="form_data">
                <div class="label">
                    <label for="name">Name</label>
                    <span id="name_error"></span>
                </div>
                <input type="text" name="name" id="name" value="" oninput="name_case()">
            </div>
            <div class="form_data">
                <div class="label">
                    <label for="email">Email</label>
                    <span id="email_error"></span>
                </div>
                <input type="email" name="email" id="email" value="" oninput="email_case()">
            </div>
            <div class="form_data">
                <div class="label">
                    <label for="mobile">Mobile</label>
                    <span id="mobile_error"></span>
                </div>
                <input type="text" name="mobile" oninput="num_case()" value="" id="mobile">
            </div>
            <div class="form_data">
                <div class="label">
                    <label for="password">Password</label>
                    <span id="password_error"></span>
                </div>
                <input type="password" name="password" id="password" value="" oninput="pcp_validation()">
            </div>
            <div class="form_data">
                <div class="label">
                    <label for="c_password">Confirm Password</label>
                    <span id="c_password_error"></span>
                </div>
                <input type="password" name="c_password" id="c_password" oninput="pcp_validation()">
            </div>
            <div class="form_data">
                <input type="reset" value="Reset">
                <button type="submit" onclick="update_validation(event)">Submit</button>
            </div>
        </div>

    </form>
    </div>
    <script>
        function Update(id, name, email, mobile, password) {
            console.log("Updating user with ID:", id);
            document.getElementById("name").value = name;
            document.getElementById("email").value = email;
            document.getElementById("mobile").value = mobile;
            document.getElementById("password").value = password;
            document.getElementById("my_form").action = "update_api.php?id=" + id;
        }
    </script>
    <script>
        function update_validation(event) {
            event.preventDefault(); 
            let name_input = document.getElementById("name");
            let name_value = name_input.value.trim();
            let email_input = document.getElementById("email");
            let email_value = email_input.value.trim();
            let mobile_input = document.getElementById("mobile");
            let mobile_value = mobile_input.value.trim();
            let password_input = document.getElementById("password");
            let password_value = password_input.value.trim();
            let name_error = document.getElementById("name_error");
            let email_error = document.getElementById("email_error");
            let mobile_error = document.getElementById("mobile_error");
            let password_error = document.getElementById("password_error");

            // Validation flags
            let error_flag = true;

            // Validate Name
            if (name_value === "") {
                name_error.innerText = "Name is required.";
                error_flag = false;
            } else {
                name_error.innerText = "";
            }

            // Validate Email
            if (email_value === "") {
                email_error.innerText = "Email is required.";
                error_flag = false;
            } else {
                email_error.innerText = "";
            }

            // Validate Mobile
            if (mobile_value === "") {
                mobile_error.innerText = "Mobile number is required.";
                error_flag = false;
            } else {
                mobile_error.innerText = "";
            }

            // Validate Password
            if (password_value === "") {
                password_error.innerText = "Password is required.";
                error_flag = false;
            } else {
                password_error.innerText = "";
            }

            if (error_flag) {
                let form_action = document.getElementById("my_form").action;
                let url_params = new URLSearchParams(form_action.split('?')[1]);
                let id = url_params.get('id');

                let parameters = "id=" + id + "&name=" + name_value + "&email=" + email_value + "&mobile=" + mobile_value + "&password=" + password_value;
                console.log("Parameters:", parameters);

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    let result = this.responseText;
                    try {
                        result = JSON.parse(result);

                        if (result.name_error) {
                            name_error.innerText = result.name_error;
                        }
                        if (result.email_error) {
                            email_error.innerText = result.email_error;
                        }
                        if (result.mobile_error) {
                            mobile_error.innerText = result.mobile_error;
                        }
                        if (result.password_error) {
                            password_error.innerText = result.password_error;
                        }

                        // Handle success
                        if (result.success) {
                            alert(result.success);
                            window.location.reload(); 
                        }
                    } catch (e) {
                        alert("error occurred");
                    }
                };

                xhttp.open("GET", "http://localhost/userdatabase/update_api.php?" + parameters, true);
                    xhttp.send();
            }
        }
    </script>
    </body>

</html>