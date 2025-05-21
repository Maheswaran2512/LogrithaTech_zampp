<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form with Flex</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        #form_container {
            margin: auto;
            padding: 20px;
            background-color: rgb(255, 255, 255);
            align-items: center;
            /* height: 300px; */
            width: 350px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0px 0px 30px rgb(55, 55, 66);
            border: 3px solid rgba(216, 236, 194, 0.466);
            border-radius: 30px;
        }
        .form_data {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 100%;
        }
        h1 {
            margin-bottom: 40px;
            text-align: center;
            padding: 10px;
        }
        input {
            padding: 5px;
        }
        label {
            text-transform: uppercase;
            font-size: 14px;
        }
        .label {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        span {
            font-size: x-small;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <?php
    $name = "";
    $email = "";
    $mobile = "";
    $password = "";
    $error_flag = true;
    if (isset($_GET["id"])) {
        if ($_GET["id"] != "") {
            $id = $_GET["id"];
        } else {
            echo ("ID Value Not Found <br>");
            $error_flag = false;
        }
    } else {
        echo ("ID Parameter Not Found <br>");
        $error_flag = false;
    }
    if ($error_flag) {
        require ("db.php");
        if (!$db_error) {
            $select_query = "SELECT * FROM user_table WHERE id='$id'";
            $result = $conn->query($select_query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["name"];
                    $email = $row["email"];
                    $mobile = $row["mobile"];
                    $password = $row["password"];
                }
            } else {
                echo ("ID not found");
            }
        }


        ?>
        <form action="http://localhost/userdatabase/" method="get" id="my_form">
       <div id=form_container>
                <div class="form_data">
                    <div class="label">
                        <label for="name">Name</label>
                        <span id="name_error"></span>
                    </div>
                    <input type="text" name="name" id="name" value=<?php echo "$name" ?> oninput="name_case()">
                </div>
                <div class="form_data">
                    <div class="label">
                        <label for="email">Email</label>
                        <span id="email_error"></span>
                    </div>
                    <input type="email" name="email" id="email" value=<?php echo "$email" ?> oninput="email_case()">
                </div>
                <div class="form_data">
                    <div class="label">
                        <label for="mobile">Mobile</label>
                        <span id="mobile_error"></span>
                    </div>
                    <input type="text" name="mobile" oninput="num_case()" value=<?php echo "$mobile" ?> id="mobile">
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
            function update_validation(event) {
                event.preventDefault();
                let name_input = document.getElementById("name");
                let name_value = name_input.value.trim();

                let email_input = document.getElementById("email");
                let email_value = email_input.value.trim();

                let mobile_input = document.getElementById("mobile");
                let mobile_value = mobile_input.value.trim();

                let password_input = document.getElementById("password");
                let password_value = mobile_input.value.trim();

                let name_error = document.getElementById("name_error");
                let email_error = document.getElementById("email_error");
                let mobile_error = document.getElementById("mobile_error");
                let password_error = document.getElementById("password_error");
                let my_form = document.getElementById("my_form");
                let error_flag = true;
                // Validate Name
                if (name_value === "") {
                    error_flag = false;
                } else {
                    name_error.innerText = "";
                }
                // Validate Email
                if (email_value === "") {
                    error_flag = false;
                } else {
                    email_error.innerText = "";
                }
                // Validate Mobile
                if (mobile_value === "") {
                    error_flag = false;
                } else {
                    mobile_error.innerText = "";
                }
                // Validate Password
                if (password_value === "") {
                    error_flag = false;
                } else {
                    password_error.innerText = "";
                }
                // All validations passed — submit
                // my_form.submit();
                error_flag = true;
                if (error_flag) {
                    let parameters = "update_api.php?name=" + name_value + "&email=" + email_value + "&mobile=" + mobile_value + "&password=" + password_value + "&id=<?php echo ($id); ?>";
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function () {
                        let result = this.responseText;
                        alert(result);
                        result = JSON.parse(result);

                        if (result.name_error != "") {
                            name_error.innerText = result.name_error;
                        }
                        if (result.email_error != "") {
                            email_error.innerText = result.email_error;
                        }
                        if (result.mobile_error != "") {
                            mobile_error.innerText = result.mobile_error;
                        }
                        if (result.password_error != "") {
                            password_error.innerText = result.password_error;
                        }
                        if (result.success != "") {
                            alert(result.success);
                            alert(result.delete)
                        }
                    }
                    xhttp.open("GET", "http://localhost/userdatabase/" + parameters, true);
                    xhttp.send();
                }

            }

        </script>
        <!-- <script>
        function validation(event){
            event.preventDefault();
            // alert("Working");
            // regular expressions

            name_input=document.getElementById("name");
            my_form=document.getElementById("my_form");
            if(name_input.value==""){
                var name_error=document.getElementById("name_error");
                name_error.innerText="Please Enter your Name";
                // alert("Please Enter your Name");
            }else{
                var name_error=document.getElementById("name_error");
                name_error.innerText="";
               
                // alert(name_input.value);
            }

            email_input=document.getElementById("email");
            if(email_input.value==""){
                // alert("Please Enter your email")
            }else{
                // alert(email_input.value);
            }   

            form.submit()
        }
    </script> -->
        <?php
    }
    ?>
</body>

</html>