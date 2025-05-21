
function fetchStudents() {
    let parameters = 'http://localhost/userdatabase/students_list.php'; // API URL
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        let result = JSON.parse(this.responseText);
        if (result.db_error) {
            document.getElementById('error-message').textContent = result.db_error;
            document.getElementById('error-message').style.display = 'block';
            return;
        }
        const table = document.getElementById('students-table');
        table.innerHTML = '';
        table.innerHTML = '<tr>' +
            '<th>ID</th>' +
            '<th>Name</th>' +
            '<th>Email</th>' +
            '<th>Mobile</th>' +
            '<th>Action</th>' +
            '</tr>';
        if (result.students && result.students.length > 0) {
            // Use a 'for' loop to iterate over the students array
            for (let i = 0; i < result.students.length; i++) {
                const student = result.students[i];
                const row = document.createElement('tr');
                // String concatenation instead of template literals
                row.innerHTML = '<td>' + student.id + '</td>' +
                    '<td>' + student.name + '</td>' +
                    '<td>' + student.email + '</td>' +
                    '<td>' + student.mobile + '</td>' +
                    '<td style=display:flex;justify-content:space-between;><button onclick="Delete(' + student.id + ')">Delete</button><button onclick="Update(' + student.id + ')">Update</button></td>';
                table.appendChild(row);
            }
        }
        else {
            document.getElementById('error-message').textContent = 'No students found.';
            // document.getElementById('error-message').style.display = 'block';
        }
    };
    // Open the request and send it
    xhttp.open("GET", parameters, true);
    xhttp.send();
}

function add_student() {

}