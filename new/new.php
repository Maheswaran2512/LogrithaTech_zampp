<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <button onclick="loadDoc()"> click me</button>

    <script>
        function loadDoc() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
            }
            xhttp.open("GET", "new.txt", true);
            xhttp.send();
        }
    </script>
</body>

</html>