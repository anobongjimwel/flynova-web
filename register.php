<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if ((isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: dashboard.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova - Register Account</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2>Register<span class="d-none d-md-inline">&nbsp;Account</span></h2></div>
                    </div>
                </div>
            </div>
            <div class="row" style="min-height: 100vh">
                <div class="container pt-5 pb-5">
                    <div class="row">
                        <div class="col-md-6 d-none pt-3 pb-3" style="background-color: rgba(255,255,255,0.76)">

                        </div>
                        <div class="col-md-6 col-12 col offset-md-3 pt-3 pb-3" style="background-color: rgba(255,255,255,0.76)">
                            <div class="row">
                                <div class="col-12">
                                    <div class="notice"></div>
                                </div>
                            </div>
                            <form method="post" onSubmit="return checkForm()" enctype="application/x-www-form-urlencoded">
                            <div class="row">
                                <div class="col-12">
                                    <span style="font-size: 1.25em">Email Address:</span>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" />
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Username:</span>
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Full Name:</span>
                                    <input class="form-control" type="text" id="fullName" name="fullName" placeholder="Full Name" />
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Nickname:</span>
                                    <input class="form-control" type="text" id="nickname" name="nickname" placeholder="Nickname" />
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Country:</span>
                                    <select class="form-control"id="country" name="country" autofocus="" id="country">
                                        <option value="">Choose one...</option>
                                        <?php foreach (NationalityHandler::getCountryNames() as $country) { ?>
                                            <option value="<?= $country['id'] ?>"><?= $country['country'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Password:</span>
                                    <input class="form-control" type="text" id="password" name="password" placeholder="Password" />
                                </div>
                                <div class="col-12 pt-4">
                                    <span style="font-size: 1.25em">Confirm Password:</span>
                                    <input class="form-control" type="password"  id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" />
                                </div>
                                <div class="col-12 pt-4">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn" type="submit" name="register" >Register</button><button class="btn btn-danger btn" type="reset">Clear</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");

            function checkForm() {
                iziToast.destroy();
                let email = document.getElementById("email");
                let fullName = document.getElementById("fullName");
                let nickname = document.getElementById("nickname");
                let username = document.getElementById("username");
                let country = document.getElementById("country");
                let password = document.getElementById("password");
                let confirmPassword = document.getElementById("confirmPassword");
                let proceed = true;

                function validateEmail(email) {
                    let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                }

                if (email.value == "") {
                    iziToast.warning({
                        title: 'Email address is empty!',
                        message: 'Your email address is needed here.',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                } else if (validateEmail(email.value) == false) {
                    iziToast.warning({
                        title: 'Email address not valid!',
                        message: 'Consider your email\'s format.',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (fullName.value == "") {
                    iziToast.warning({
                        title: 'Full name is empty!',
                        message: 'Consider your email\'s format.',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }

                if (username.value == "") {
                    iziToast.warning({
                        title: 'Username is empty!',
                        message: 'Please choose a username of your choice',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (nickname.value == "") {
                    iziToast.warning({
                        title: 'Nickname is empty!',
                        message: 'Please fill in the nickname field',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (country.value == 0 || country.value == null) {
                    iziToast.warning({
                        title: 'Country is not selected!',
                        message: 'Please choose a country that you live in',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (password.value == "") {
                    iziToast.warning({
                        title: 'Password field empty!',
                        message: 'Please type in your desired password',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (confirmPassword.value == "") {
                    iziToast.warning({
                        title: 'Password confirmation is empty!',
                        message: 'Please type your password again properly',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                } else if (password.value != confirmPassword.value) {
                    iziToast.warning({
                        title: 'Passwords do not match!',
                        message: 'Retype your password',
                        close: true,
                        layout: 2,
                        drag: false,
                        target: '.notice',
                        targetFirst: true,
                        pauseOnHover: false,
                        timeout: false,
                        progressBar: false
                    });
                    proceed = false;
                }
                if (proceed) {
                    let xmlHttp = new XMLHttpRequest();
                    xmlHttp.onreadystatechange = function (ev) {
                        if (this.status == 200 && this.readyState == 4) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    title: 'Successfully registered!',
                                    message: 'You will be redirected in a few seconds. Please wait.',
                                    close: true,
                                    layout: 2,
                                    drag: false,
                                    target: '.notice',
                                    targetFirst: true,
                                    pauseOnHover: false,
                                    timeout: 5000,
                                    progressBar: false,
                                    onClosed: function () {
                                        location.href = "login.php";
                                    }
                                });
                            } else {
                                iziToast.warning({
                                    title: 'Server response:',
                                    message: this.responseText,
                                    close: true,
                                    layout: 2,
                                    drag: false,
                                    target: '.notice',
                                    targetFirst: true,
                                    pauseOnHover: false,
                                    timeout: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                    xmlHttp.open('post', 'fcns/ajax/registrationProcessor.php', false);
                    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    let values =
                        "email=" + email.value + "&" +
                        "name=" + fullName.value + "&" +
                        "nickname=" + nickname.value + "&" +
                        "country=" + country.value + "&" +
                        "password=" + password.value + "&" +
                        "username=" + username.value + "&" +
                        "register=";
                    xmlHttp.send(values);
                }
                return false;
            }
        </script>
    </body>
</html>