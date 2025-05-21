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
            fetchStudents();
            // window.location.href = "";
        }
    }
    xhttp.open("GET", "http://localhost/userdatabase/delete_api.php" + parameters, true);
    xhttp.send();
}