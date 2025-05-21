// validation function
let submit = document.getElementById("submit_form");
submit.addEventListener("click", function (event) {
    event.preventDefault();
    let my_form = document.getElementById("my_form");
    feild_inputs = ["name", "email", "mobile", "message"];
    // if ((radio_validation() && checkbox_validation()) && input_validation(feild_inputs) ) {
    if (input_validation(feild_inputs) && radio_validation() && checkbox_validation()) {
        // if (input_validation(feild_inputs)) {
        alert("Message Send Successfully \n\n Our Team will Reach you soon...")
        // document.getElementById("success").innerText = "We will ReachYou Soon";
        // console.log("submit");
        // my_form.submit();
        name = $("#name").val();
        email = $("#email").val();
        mobile = $("#mobile").val();
        message = $("#message").val();
        // radio=$("radio")
        form=document.getElementById("my_form");
        form_data=new FormData(form);
        parameters=new URLSearchParams(form_data).toString();

        // parameters = "?name=" + name + "&email=" + email + "&mobile=" + mobile + "&message=" + message + "&radio=testradio" + "&checkbox%5B%5D=ccheckedd";
        alert(parameters);
        loadDoc(parameters);

    } else {
        console.log("error");
    }
    // feild_inputs.value="";
});


function loadDoc(parameters) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        // document.getElementById("demo").innerHTML = this.responseText;
        alert(this.responseText);
    }
    xhttp.open("GET", "valid.php?" + parameters, true);
    xhttp.send();
}

// e
// mailjs.init('ixPPgpfnPjX6KgqX1');
// const templateParams = {
//     from_name: document.getElementById('name').value,
//     from_email: document.getElementById('email').value,
//     from_mobile: document.getElementById('mobile').value,
//     message: document.getElementById('message').value
// };
// emailjs.send('service_qr94m2m', 'template_1u8km3t', templateParams)
//     .then(() => {
//         alert('Message sent successfully! Thank you for contacting us! We will get back to you soon!');
//     })
//     .catch((error) => {
//         alert('Error sending message: ' + error.text);
//     });
// self-predefined function for box
function box_error(box, color) {
    box.style.borderWidth = "2px";
    box.style.borderColor = color;
    box.style.outline = "none";
}

// email validation function
function email_validation() {
    let email_input = document.getElementById("email");
    email_input.value = email_input.value.toLowerCase();
    const emailReg = /^[a-z0-9._]+@[a-z]+\.[a-z]{2,}$/;
    if (emailReg.test(email_input.value)) {
        box_error(email_input, "green");
        return true;
    } else {
        box_error(email_input, "red");
        return false;
    }
}

// mobile validation function
function mobile_validation() {
    let mobile_input = document.getElementById("mobile");
    const mobilereg = /^[6789][0-9]{9}$/;
    if (mobilereg.test(mobile_input.value)) {
        console.log(mobile_input);
        box_error(mobile_input, "green");
        return true;
    } else {
        box_error(mobile_input, "red");
        return false;
    }
}

// radio button validation function
function radio_validation() {
    event.preventDefault();
    radio_input = document.getElementsByName("radio");
    radio_error = document.getElementById("radio_error");
    for (let i = 0; i < radio_input.length; i++) {
        if (radio_input[i].checked) {
            radio_error.innerText = ""
            return true;
        }
    }
    radio_error.innerText = "Select";
    return false;
}

// checkbox validaiton function
function checkbox_validation() {
    event.preventDefault();
    checkbox_input = document.getElementsByName("checkbox[]");
    checkbox_error = document.getElementById("checkbox_error");
    for (let i = 0; i < checkbox_input.length; i++) {
        if (checkbox_input[i].checked) {
            console.log(checkbox_input);
            console.log(checkbox_input.length);
            checkbox_error.innerText = "";
            return true;
        }
    }
    checkbox_error.innerText = "*";
    return false;
}


// self pre-defined input validation function
function input_validation(feild_inputs) {
    let feild_count = feild_inputs.length;
    let feild_flag = 0;
    for (let i = 0; i < feild_inputs.length; i++) {
        let input = document.getElementById(feild_inputs[i]);
        let validate_funcation = feild_inputs[i] + "_validation()";
        if (input.value == "") {
            box_error(input, "red");
        } else {
            try {
                let validation = eval(validate_funcation);
                console.log(validate_funcation + [i]);
                if (validation) {
                    console.log(validate_funcation + [i] + "work aguthu");
                    box_error(input, "lightgreen");
                    feild_flag = feild_flag + 1;
                }
            } catch {
                console.log("Function Error (not found)");
                box_error(input, "lightgreen");
                feild_flag = feild_flag + 1;
            } finally {
                console.log("finaly" + [i])
            }
        }
    }
    console.log(feild_flag);
    if (feild_count === feild_flag) {
        return true;
    } else {
        return false;
    }
}

// function validation() {
//     event.preventDefault();
//     let my_form = document.getElementById("my_form");
//     //req documents for validation
//     feild_inputs = ["name", "email", "mobile", "message"];

//     // email_fun = ["email_validation()"];
//     // mobile_fun = ["mobilereg_validation()"];

//     // functions = ["",email_validation(), mobile_validation(),""];
//     input_validation(feild_inputs);

//     // if (input_validation(feild_inputs)) {
//     //     my_form.submit();
//     //     console.log('submit');
//     // }
// }
// document.getElementById('submit_form').addEventListener('click', function () {
//     event.preventDefault();
//     emailjs.init('ixPPgpfnPjX6KgqX1');
//     const templateParams = {
//         from_name: document.getElementById('name').value,
//         from_email: document.getElementById('email').value,
//         message: document.getElementById('message').value
//     };
//     emailjs.send('service_qr94m2m', 'template_1u8km3t', templateParams)
//         .then(() => {
//             alert('Message sent successfully! Thank you for contacting us! We will get back to you soon!');
//         })
//         .catch((error) => {
//             alert('Error sending message: ' + error.text);
//         });
// });