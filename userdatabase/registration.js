function input_error(element, color) {
    element.style.borderWidth = "2px";
    element.style.borderColor = color;
    element.style.outline = "none";
}

function text_error(element, color) {
    element.style.fontWeight = "bold";
    element.style.color = color;
}

function input_validation(id, error_msg) {
    let feild_name = document.getElementById(id);
    let feild_error = document.getElementById(id + "_error");
    if (feild_name.value == "") {
        alert("");
        feild_error.innerText = error_msg;
        input_error(feild_name, "red");
        text_error(feild_error, "red");
        return false;
    } else {
        feild_error.innerText = "";
        input_error(feild_name, "green");
        text_error(feild_error, "green");
        // feild_name + casee();
        return true;
    }
}

// function name_check() {
//     let name_input = document.getElementById("name");
//     let name_error = document.getElementById("name_error");
//     if (name_input.value == "") {
//         // alert("Enter");
//         name_error.innerText = "Enter Your Name";
//         error = false;
//         input_error(name_input, "red");
//         text_error(name_error, "red");
//     } else {
//         name_error.innerText = "";
//         uppercase();
//     }
// }

function name_case() {
    let name_input = document.getElementById("name1");
    let name_error = document.getElementById("name1_error");
    const namereg = /^[a-zA-Z ]+$/;
    if (namereg.test(name_input.value)) {
        name_input.value = name_input.value.toUpperCase();
        name_error.innerText = "";
        input_error(name_input, "lightgreen");
    } else {
        name_error.innerText = "INVALID INPUT";
        input_error(name_input, "red");
        text_error(name_error, "red");
    }
    console.log("wrok");

}

function email_case() {
    let email_input = document.getElementById("email1");
    let email_error = document.getElementById("email1_error");
    email_input.value = email_input.value.toLowerCase();


    const emailReg = /^[a-z0-9._]+@[a-z]+\.[a-z]{2,}$/;
    console.log("email");
    if (emailReg.test(email_input.value)) {
        input_error(email_input, "lightgreen");
        email_error.innerText = "Valid email";
        text_error(email_error, "green");
        console.log("email true");
    } else {
        email_error.innerText = "Enter valid mail id";
        input_error(email_input, "red");
        text_error(email_error, "red");
        console.log("email false");
    }

}

function num_case() {
    let mobile_input = document.getElementById("mobile1");
    let mobile_error = document.getElementById("mobile1_error");
    const mobilereg = /^[0-9]{10}$/;
    if (mobilereg.test(mobile_input.value)) {
        mobile_error.innerText = "";
        input_error(mobile_input, "lightgreen");
    }
    else {
        mobile_error.innerText = "Enter 10 Digit";
        input_error(mobile_input, "red");
        text_error(mobile_error, "red");
    }
}

function pcp_validation() {
    let password = document.getElementById("password1");
    let c_password = document.getElementById("c_password1");
    let password_error = document.getElementById("password1_error");
    let c_password_error = document.getElementById("c_password1_error");
    const passrex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    errors = true;
    if (password.value == "") {
        password_error.innerText = "Enter Password";
        text_error(password_error, "red");
        input_error(password, "red");
        errors = false;
    } else if (!passrex.test(password.value)) {
        password_error.innerText = "password must contains Uppercase LowerCase number spl";
        errors = false;
    } else {
        password_error.innerText = "";
    }

    if (c_password.value == "") {
        // alert("if");
        c_password_error.innerText = "Enter Confirm Password";
        text_error(c_password_error, "red");
        input_error(c_password, "red");
        errors = false;
    } else {
        // alert("error")
        c_password_error.innerText = "";
    }

    if (password.value != "" && c_password.value != "") {
        if (password.value == c_password.value) {
            c_password_error.innerText = "Valid*";
            text_error(c_password_error, "green");
            input_error(c_password, "green");
            input_error(password, "green");
        } else {
            c_password_error.innerText = "Mismatch Password**";
            text_error(c_password_error, "red");
            input_error(c_password, "red");
            input_error(password, "red");
            errors = false;
        }
    }
    return errors;
}


function validation(event) {
    event.preventDefault();
    console.log("validation func");
    let name_input = document.getElementById("name1");
    let email_input = document.getElementById("email1");
    let mobile_input = document.getElementById("mobile1");
    let password = document.getElementById("password1");
    let c_password = document.getElementById("c_password1");
    let name_error = document.getElementById("name1_error");
    let registration_form = document.getElementById("registration_form");
    let error = true;

    if (!input_validation("name1", "Enter Your Name")) {
        error = false;
    } else {
        name_case();
    }

    if (!input_validation("email1", "Enter Your Email NEW")) {
        console.log("email false v");
        error = false;
    } else {
        console.log("email tru v");
        email_case();
    }

    if (!input_validation("mobile1", "Enter Your Mobile Number NEw")) {
        error = false;
    } else {
        num_case();
    }

    if (!pcp_validation()) {
        error = false;
    }

    if (name_input.value == "" || email_input.value == "" || mobile_input.value == "" || password.value == "" || c_password.value == "" || password.value != c_password.value) {
        error = false;
        event.preventDefault();
        console.log(error);
    }

    if (error) {

        alert("working");
        // registration_form.submit();
        // console.log('submit');
        // loadDoc();
        // form = document.getElementById("my_form");
        // form_data = new FormData(form);
        // parameters = new URLSearchParams(form_data).toString();
        let parameters = "name=" + name_input.value + "&email=" + email_input.value + "&mobile=" + mobile_input.value + "&password=" + password.value;

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            // alert(this.responseText);
            let result = this.responseText;
            alert(result);
            result = JSON.parse(result);
            alert(result, "json");
            alert(result.name_error);
            if (result.success != "") {
                alert(result.success);
            } else {
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
            }
            // alert(result.name_error);
            // alert(result.email_error);
            // alert(result.mobile_error);
            // alert(result.success);
        }
        xhttp.open("GET", "http://localhost/userdatabase/registration.php?" + parameters, true);
        xhttp.send();
    }
}
