<footer class="container-fluid bg-secondary">
    <div class="container">
        <div class="row pb-4 pt-4">
            <div class="col-lg-8 col-12 text-white text-center text-lg-left p-0">
                        <span style="font-size: 0.75em">
                            ©2019 Jimwel Anobong, Orven Manzano, Jessica Echon
                        </span>
            </div>
            <div class="col-lg-4 col-12 text-white text-center text-lg-right p-0">
                        <span style="font-size: 0.75em">
                            Thesis Made in STI College of Novaliches
                        </span>
            </div>
        </div>
    </div>
</footer>
<script>
    $(document).ready(function(){
        $('[data-tooltip="tooltip"]').tooltip();

        $('[data-toggle="tooltip"]').tooltip();
    });

    function login() {
        const username = document.getElementById('nav_username').value;
        const password = document.getElementById('nav_password').value;
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState==4 && this.status==200) {
                if (this.responseText=="GOOD") {
                    iziToast.show({
                        title: 'Logged in successfully!',
                        message: 'Please wait a moment.',
                        backgroundColor: "#e626eb",
                        close: false,
                        layout: 2,
                        drag: false,
                        target: '.loginMessage',
                        theme: 'dark',
                        targetFirst: true,
                        displayMode: 'replace',
                        pauseOnHover: false,
                        timeout: 3001
                    });
                    setTimeout(function () {
                        location.href="dashboard.php";
                    }, 3000);
                    return true;
                } else {
                    iziToast.show({
                        title: 'Wrong credentials!',
                        message: 'Please try again.',
                        close: false,
                        backgroundColor: "#dc1d5a",
                        theme: "dark",
                        layout: 2,
                        drag: false,
                        target: '.loginMessage',
                        targetFirst: true,
                        displayMode: 'replace',
                        pauseOnHover: false,
                        timeout: 5000
                    });
                    return false;
                }
            }
        };
        xmlHttp.open("POST","fcns/ajax/login.php", false);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send("username="+username+"&password="+password);
    }

    function logout() {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState==4 && this.status==200) {
                if (this.responseText=="GOOD") {
                    location.reload();
                    return true;
                } else {
                    return false;
                }
            }
        };
        xmlHttp.open("GET","fcns/ajax/logout.php", false);
        xmlHttp.send();
    }

    // Notification Display

    setInterval(function () {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response!="NONE") {
                    let vars = this.response.split("|");
                    iziToast.show({
                        title: vars[1],
                        message: vars[2],
                        icon: vars[3],
                        image: vars[4],
                        progressBar: true,
                        close: true,
                        drag: true,
                        position: "topCenter",
                        layout: 2,
                        theme: "dark",
                        pauseOnHover: false,
                        backgroundColor: '#cb0044',
                        buttons: [
                            ['<button><span class="fa fa-anchor"></span> <b>Open</b></button>', function (instance, toast, button, e, inputs) {
                                let notificationRead = new XMLHttpRequest();
                                notificationRead.open("post", "fcns/ajax/notifications/setNotificationAsRead.php");
                                notificationRead.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                                notificationRead.send("notificationId="+vars[0]);
                                // Subtract -1 on the notification window
                                location.href = vars[5];
                                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                            }, false],
                            ['<button><span class="fa fa-envelope-open"></span> <b>Mark as read</b></button>', function (instance, toast, button, e, inputs) {
                                let notificationRead2 = new XMLHttpRequest();
                                notificationRead2.open("post", "fcns/ajax/notifications/setNotificationAsRead.php");
                                notificationRead2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                                notificationRead2.send("notificationId="+vars[0]);
                                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                            }, false],
                            ['<button><span class="fa fa-close"></span> <b>Dismiss</b></button>', function (instance, toast, button, e, inputs) {
                                // Just dismiss
                                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                            }, false]
                        ],
                        onOpened: function () {
                            let notificationShown = new XMLHttpRequest();
                            notificationShown.open("post", "fcns/ajax/notifications/setNotificationAsShown.php");
                            notificationShown.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                            notificationShown.send("notificationId="+vars[0]);
                        }
                    });
                }
            }
        };
        xmlHttp.open("get", "fcns/ajax/notifications/getLatestNotification.php", false);
        xmlHttp.send();
    }, 5000);
</script>