<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <?php
    // Replace database connection details with your own
    include("config.php");

    // DUHET ME ARDHE PREJ SESSIONIT
    $userID = 2;

    // Fetch user data from the database
    $sql = "SELECT * FROM user WHERE ID_Perdoruesi = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rreshti = $result->fetch_assoc();
    } else {
        echo "User not found.";
        $conn->close();
        exit();
    }

    $conn->close();
    ?>

    <form method="post" action="modify_profile.php" enctype="multipart/form-data">
        <div class="wrapper">
            <div class="top-icons">
                <i class="fas fa-long-arrow-alt-left"></i>
                <i class="fas fa-ellipsis-v"></i>
                <i class="far fa-heart"></i>
            </div>

            <div class="profile" id="profileSection">
                <!-- Bëni foton clickable -->
                <label for="newImage" id="imageLabel">
                    <?php echo '<img src="data:foto/jpeg;base64,' . base64_encode($rreshti['Foto']) . '" width="100%" height="100%" class="thumbnail" id="previewImage">'; ?>
                </label>

                <div class="check"><i class="fas fa-check"></i></div>
                <h3 class="name"><span id="firstName"><?php echo $rreshti['first_name']; ?></span> <span
                        id="lastName"><?php echo $rreshti['last_name']; ?></span></h3>
                <p class="title" id="email"><?php echo $rreshti['email']; ?></p>
                <p class="description" id="telefoni"><?php echo $rreshti['Telefoni']; ?></p>
                <input type="hidden" name="ID_Perdoruesi" value="<?php echo $rreshti['ID_Perdoruesi']; ?>">

                <!-- Shto input për zgjedhjen e imazhit -->
                <input type="file" name="newImage" id="newImage" style="display: none;" accept="image/*">
                <button type="button" class="btn" onclick="toggleEditMode()">Modifiko</button>
            </div>
        </div>

        <div class="social-icons">
            <div id="responseMessage"></div>

            <!-- Add your social icons here -->
        </div>
        </div>
    </form>

    <script>
    $(document).ready(function() {
        // Ngjarja click e label-it të fajllit
        $('#imageLabel').click(function() {
            // Kërkojë klikimin në inputin e fajllit
            $('#newImage').click();
        });

        // Ngjarja change e inputit të fajllit
        $('#newImage').change(function(e) {
            // Kthehet objekti e ngjarjes
            var input = e.target;

            // Sigurohuni se ka një fajll të zgjedhur
            if (input.files && input.files[0]) {
                // Lexoni fajllin e zgjedhur
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Vendosni pamjen paraprake të imazhit
                    $('#previewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    function toggleEditMode() {
        var firstName = document.getElementById('firstName');
        var lastName = document.getElementById('lastName');
        var email = document.getElementById('email');
        var telefoni = document.getElementById('telefoni');

        var firstNameInput = createInput(firstName.innerText);
        var lastNameInput = createInput(lastName.innerText);
        var emailInput = createInput(email.innerText);
        var telefoniInput = createInput(telefoni.innerText);

        replaceElementWithInput(firstName, firstNameInput);
        replaceElementWithInput(lastName, lastNameInput);
        replaceElementWithInput(email, emailInput);
        replaceElementWithInput(telefoni, telefoniInput);

        var button = document.querySelector('.btn');
        button.innerHTML = 'Ruaj Ndryshimet';
        button.setAttribute('onclick', 'saveChanges()');
    }

    function createInput(value) {
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('value', value);
        return input;
    }

    function replaceElementWithInput(element, input) {
        element.innerHTML = ''; // Fshij përmbajtjen aktuale të elementit
        element.appendChild(input);
    }

    function saveChanges() {
        var userID = document.querySelector('input[name="ID_Perdoruesi"]').value;

        var firstNameInput = document.querySelector('#firstName input');
        var lastNameInput = document.querySelector('#lastName input');
        var emailInput = document.querySelector('#email input');
        var telefoniInput = document.querySelector('#telefoni input');

        var firstName = createSpan(firstNameInput.value);
        var lastName = createSpan(lastNameInput.value);
        var email = createSpan(emailInput.value);
        var telefoni = createSpan(telefoniInput.value);

        replaceInputWithElement(firstNameInput, firstName);
        replaceInputWithElement(lastNameInput, lastName);
        replaceInputWithElement(emailInput, email);
        replaceInputWithElement(telefoniInput, telefoni);

        var button = document.querySelector('.btn');
        button.innerHTML = 'Modifiko';
        button.setAttribute('onclick', 'toggleEditMode()');

        // Përdor AJAX për të dërguar të dhënat e përdoruesit për përditësim
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "modify_profile.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Përpunoni përgjigjen JSON
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        console.error(response.error);
                        document.getElementById('responseMessage').innerHTML = 'Gabim gjatë përditësimit';
                    } else {
                        console.log("Të dhënat janë përditësuar me sukses!");
                        document.getElementById('responseMessage').innerHTML =
                            'Të dhënat janë përditësuar me sukses!';
                    }
                } else {
                    console.error("Gabim gjatë dërgimit të kërkesës: " + xhr.status);
                    document.getElementById('responseMessage').innerHTML = 'Gabim gjatë përditësimit';
                }
            }
        };

        // Krijoni një string me të dhënat e përdoruesit për tu dërguar
        var data = "modify=true&ID_Perdoruesi=" + userID +
            "&first_name=" + encodeURIComponent(firstName.innerText) +
            "&last_name=" + encodeURIComponent(lastName.innerText) +
            "&email=" + encodeURIComponent(email.innerText) +
            "&Telefoni=" + encodeURIComponent(telefoni.innerText);

        xhr.send(data);
    }

    function createSpan(value) {
        var span = document.createElement('span');
        span.innerText = value;
        return span;
    }

    function replaceInputWithElement(input, element) {
        input.parentNode.replaceChild(element, input);
    }
    </script>

</body>

</html>