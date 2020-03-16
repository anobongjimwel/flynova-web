<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta property="og:type" content="website">

<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link href="assets/css/animate.css" rel="stylesheet" />
<link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet" />
<link rel="apple-touch-icon" type="image/png" href="assets/img/icons/iphone-icon.png" /><!-- iPhone -->
<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="assets/img/icons/ipad-icon.png" /><!-- iPad -->
<link rel="apple-touch-icon" type="image/png" sizes="114x114" href="assets/img/icons/iphone-4-icon.png" /><!-- iPhone4 -->
<link rel="shortcut icon" type="image/png" href="assets/img/icons/32px.png" />
<link rel="icon" type="image/png" href="assets/img/icons/opera-speed-dial.png" /><!-- Opera Speed Dial, at least 144×114 px -->
<link rel="icon" type="image/png" sizes="33x33" href="assets/img/icons/32px.png" />
<link rel="icon" type="image/png" sizes="129x129" href="assets/img/icons/128px.png" />
<link rel="icon" type="image/png" sizes="257x257" href="assets/img/icons/256px.png" />
<link rel="icon" type="image/png" sizes="513x513" href="assets/img/icons/512px.png" />
<link rel="stylesheet" href="assets/css/iziToast.min.css">

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/tooltip.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/typed.js"></script>
<script src="assets/js/iziToast.min.js"></script>

<style>
    .tooltip {
        z-index: 9999999;
    }

    /* Navbar related */

    ul.navbar-nav div.row div li.nav-text {
        cursor: pointer;
    }

    ul.navbar-nav li.navbar-item span {
        cursor: pointer;
    }

    .navbar-collapse {
        max-height: 60vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Chrome Hiding Scrollbar */

    ::-webkit-scrollbar {
        display: none;
    }

    /* Worldwide Places */

    .continent-cards {
        background-color: rgba(0, 0, 0, 0.71);
        border: 1px solid black; box-shadow: 0 0 10px black
    }

    .bg-worldwide {
        background-image: url("assets/img/home_bg/continents/worldwide.jpg");
        background-position: center;
    }

    .bg-asia {
        background-image: url("assets/img/home_bg/continents/tokyo.jpg");
        background-position: center;
        background-size: cover;
    }

    .bg-africa {
        background-image: url("assets/img/home_bg/continents/egypt.png");
        background-position: center;
        background-size: cover;
    }

    .bg-southAmerica {
        background-image: url("assets/img/home_bg/continents/buenos_aires.jpg");
        background-position: center;
        background-size: cover;
    }

    .bg-northAmerica {
        background-image: url("assets/img/home_bg/continents/washingtondc.jpg");
        background-position: center;
        background-size: cover;
    }

    .bg-europe {
        background-image: url("assets/img/home_bg/continents/big-ben.png");
        background-position: center;
        background-size: cover;
    }

    .bg-oceania {
        background-image: url("assets/img/home_bg/continents/sydney.jpg");
        background-position: center;
        background-size: cover;
    }

    .bg-antarctica {
        background-image: url("assets/img/home_bg/continents/antarctica.jpg");
        background-position: center;
        background-size: cover;
    }
</style>

<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-1858950632103027",
        enable_page_level_ads: true
    });


    // Sound Effects
    function sound_notify() {
        var audio = new Audio('assets/sfx/airport_bell.mp3');
        audio.volume = 0.5;
        audio.play();
    }

    function sound_announce_easy() {
        var audio = new Audio('assets/sfx/easy_announce.mp3');
        audio.play();
    }

    function sound_announce_medium() {
        var audio = new Audio('assets/sfx/medium_announce.mp3');
        audio.play();
    }

    function sound_announce_hard() {
        var audio = new Audio('assets/sfx/hard_announce.mp3');
        audio.play();
    }

    // BGM
    function main_bgm_play() {
        var audio = new Audio('assets/sfx/dashboard_bgm.mp3');
        audio.volume = 0.3;
        audio.addEventListener('ended', function() {
            this.currentTime = 0;
            this.play();
        });
        audio.play();
    }

    //Navbar Setter
    function setNavbarPosition(position) {
        switch (position) {
            case "sticky-top":
                document.getElementById("onlyNavbar").classList.add("sticky-top");
                break;

            case "fixed-top":
                document.getElementById("onlyNavbar").classList.add("fixed-top");
                break
        }
    }
</script>