<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<?php
if ( isset($_GET['u']) && !empty($_GET['u']) )  {
    if (ProfileHandler::doesExistsById(ProfileHandler::getProfile($_GET['u'], "username")['id'])) {
        $profile = ProfileHandler::getProfile($_GET['u'], "username");
    } else {
        header("Location: 404.html");
        die();
    }
} else {
    $profile = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
}

$levelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($profile['id']));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova - Profile</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2><?= ucfirst($profile['nickname']) ?>'s Profile</h2></div>
                    </div>
                </div>
            </div>
            <div class="row" style="min-height: 100vh">
                <div class="container pt-0 pt-md-4">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-2 col-lg-1 text-right pr-0 pl-0">
                                <img src="assets/img/avatars/female_1.png" class="w-100" style="position: relative; top: 2px; left: -7px;"/>
                            </div>
                            <div class="col-10 col-lg-11 m-0 pl-0 pr-0 pt-1 text-white">
                                <span class="d-block overflow-hidden w-100" style="white-space: nowrap; font-size: 1em;"><?= $profile['full_name'] ?> "<?= $profile['nickname'] ?>" (@<?= $profile['username'] ?>)</span>
                                <span class="d-block" style="font-size: 0.75em">Level <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP($profile['id']))['level'] ?>, <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP($profile['id']))['name'] ?></span>
                                <div class="progress mt-2 progress-bar-striped" >
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= number_format(LevelHandler::getCurrentBaseLevel($levelRange['min'], LevelHandler::getUserXP($profile['id']), $levelRange['max'], LevelHandler::LEVEL_PERCENTAGE), 2) ?>%" aria-valuenow="<?= LevelHandler::getUserXP($profile['id']); ?>" aria-valuemin="<?= $levelRange['min'] ?>" aria-valuemax="<?= $levelRange['max'] ?>">
                                        <span style="color: black; font-weight: 600;" class="text-white">
                                            &nbsp;<?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($profile['id']))?><sup>xp</sup>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_GET['u']) && !empty($_GET['u'])) { ?>
                                <div class="col-12 pt-3 pt-md-5 pl-0 pr-0 pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-white" style="font-size: 2em;">Colleague Relationship</span>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-12 text-white">
                                            <?php if (!ColleagueRelationsHandler::doesColleagueRelationshipExists($_SESSION['username'], $_GET['u'])) { ?>
                                                    <button onclick="requestForRelationship('<?= $profile['username'] ?>')" class="loading btn btn-primary" id="colleagueMainButton" style="background-color: deeppink; border: 1px solid deeppink">
                                                        Request Colleague Relationship</button>
                                                    <p class="d-block" id="colleagueSub"  style=" word-wrap: break-word; white-space: normal">Click here to be colleagues with <?= $profile['full_name'] ?> (@<?= $profile['username']?>)</p>
                                            <?php } else {
                                            if (ColleagueRelationsHandler::identifyRelationshipStatus($_SESSION['username'], $_GET['u'])=="accepted") { ?>
                                                    <button onclick="deleteRelationship('<?= $profile['username'] ?>')" class="loading btn btn-primary" id="colleagueMainButton" style="background-color: deeppink; border: 1px solid deeppink">
                                                        Delete Colleague Relationship</button>
                                                    <p class="d-block" id="colleagueSub" style=" word-wrap: break-word; white-space: normal">You are now colleagues with <?= $profile['full_name'] ?> (@<?= $profile['username'] ?>)</p>
                                            <?php } elseif (ColleagueRelationsHandler::identifyPositionOnRelationship($_SESSION['username'], $_GET['u'])=="sender") { ?>
                                                    <button class="disabled loading btn btn-primary" id="addColleagueMainButton" style="background-color: deeppink; border: 1px solid deeppink">
                                                        Request Sent</button>
                                                    <p class="d-block" id="addColleagueSub" style=" word-wrap: break-word; white-space: normal" >Your colleague relationship has been sent</p>
                                            <?php } elseif (ColleagueRelationsHandler::identifyPositionOnRelationship($_SESSION['username'], $_GET['u'])=="reciever") { ?>
                                                    <button onclick="acceptRequestForRelationship('<?= $profile['username'] ?>')" class="loading btn btn-primary" id="colleagueMainButton" style="background-color: deeppink; border: 1px solid deeppink">
                                                        Approve Colleague Relationship Request</button>&nbsp;<button onclick="deleteRelationship('<?= $profile['username'] ?>')" class="loading btn btn-primary" id="colleagueMainButton2" style="background-color: deeppink; border: 1px solid deeppink">
                                                    Delete Colleague Relationship</button>
                                                    <p class="d-block" id="colleagueSub" style=" word-wrap: break-word; white-space: normal" ><?= $profile['full_name'] ?> (@<?= $profile['username']?>) has requested to be your colleague.</p>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="col-12 pt-3 pt-md-5 pl-0 pr-0 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em;">Colleagues</span>
                                    </div>
                                    <div class="col-12 pt-4 pr-0">
                                        <div class="row pl-2 pr-0">
                                        <?php foreach (ColleagueRelationsHandler::gatherColleaguesOfUser($profile['username']) as $colleague) {
                                        $colleagueLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($colleague['id']));
                                        $colleagueShortenedXP = LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP(ProfileHandler::getProfile($colleague['username'], ProfileHandler::PROFILE_USERNAME)['id']));

                                        ?>
                                            <div class="col-12 col-md-4 text-white pb-4">
                                                <div class="row" style="cursor: pointer;" onclick="location.href='profile.php?u=<?= $colleague['username'] ?>'">
                                                    <div class="col-1 col-md-1">
                                                        <img src="assets/img/avatars/female_1.png" style="height: 40px; position: relative; top: 2px; left: -15px;"/>
                                                    </div>
                                                    <div class="col-10 col-md-10">
                                                        <span class="d-block overflow-hidden w-100" style="white-space: nowrap; font-size: 1em;"><?= $colleague['full_name'] ?> (@<?= $colleague['nickname']?>)</span>
                                                        <span class="d-block" style="font-size: 0.75em">Level <?= $colleagueLevelRange['level'] ?>, <?= $colleagueLevelRange['name'] ?></span>
                                                        <div class="progress mt-2 progress-bar-striped" >
                                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= number_format(LevelHandler::getCurrentBaseLevel($colleagueLevelRange['min'], LevelHandler::getUserXP($colleague['id']), $colleagueLevelRange['max'], LevelHandler::LEVEL_PERCENTAGE), 2) ?>%" aria-valuenow="<?= LevelHandler::getUserXP($colleague['id']); ?>" aria-valuemin="<?= $colleagueLevelRange['min'] ?>" aria-valuemax="<?= $colleagueLevelRange['max'] ?>">
                                                        <span style="color: black; font-weight: 600;" class="text-white">
                                                            &nbsp;<?= $colleagueShortenedXP ?><sup>xp</sup>
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-3 pt-md-5 pl-0 pr-0 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em;">Booking History</span>
                                    </div>
                                    <div class="col-12 pt-4">
                                        <div style="width: 100% !important; overflow-x: scroll; white-space: nowrap; text-wrap: none; line-height: 1 !important;">
                                            <?php $bookings = BookingHandler::getBookingsByUser($profile['id']) ?>
                                            <?php foreach ($bookings as $booking) { ?>
                                                <?php $instruction = json_decode(BookingHandler::readInstruction($booking['id'],$profile['id'])['instruction'], true)?>
                                                <div class="card bg-dark text-white d-inline-block">
                                                    <?php
                                                        switch ($instruction['booking_details']['destination_continent']) {
                                                            case "Asia":
                                                                $bg = "tokyo.jpg";
                                                                break;

                                                            case "Oceania":
                                                                $bg = "sydney.jpg";
                                                                break;

                                                            case "North America":
                                                                $bg = "washingtondc.jpg";
                                                                break;

                                                            case "South America":
                                                                $bg = "buenos_aires.jpg";
                                                                break;

                                                            case "Africa":
                                                                $bg = "egypt.jpg";
                                                                break;

                                                            case "Europe":
                                                                $bg = "big_ben.jpg";
                                                                break;

                                                            case "Antarctica":
                                                                $bg = "antarctica.jpg";
                                                                break;
                                                        }
                                                    ?>
                                                    <img class="card-img" src="assets/img/profile/booking_history/<?= $bg ?>" style="width: 15em" alt="Card image">
                                                    <div class="card-img-overlay flex-column d-flex" style="box-shadow: inset 0 0 1000px #000000;">
                                                        <div class="d-inline-block align-self-stretch align-top">
                                                            <?php
                                                            switch ($instruction['booking_details']['category']) {
                                                                case "easy":
                                                                    $categ = "EASY";
                                                                    break;

                                                                case "medium":
                                                                    $categ = "MDM";
                                                                    break;

                                                                case "hard":
                                                                    $categ = "HARD";
                                                                    break;
                                                            }
                                                            ?>
                                                            <span>
                            <h1 class="card-title d-inline-block align-middle" style="font-size: 1.8em; color: white"><?= $categ ?></h1>
                            <h1 class="card-title d-inline-block float-right align-middle" style="font-size: 1.4em; color: white"><?= $booking['xp'] ?><sup>+</sup><span style="text-transform: lowercase">xp</span></h1>
                        </span>
                                                            <span>
                            <h1 style="font-size: 2em; color: white"><?= mb_strtoupper($instruction['hidden_properties']['origin_code']) ?> <span class="ion ion-ios-airplane"></span> <?= mb_strtoupper($instruction['hidden_properties']['destination_code']) ?></h1>
                        </span>
                                                        </div>
                                                        <div class="d-inline-block align-self-stretch align-bottom" style="position: relative; bottom: -100px; padding: 0 !important;">
                                                            <h2 style="font-size: 1.2em; color: white"><span class="ion ion-ios-airplane" style="color: deeppink"></span> <?= $instruction['booking_details']['class'] ?></h2>
                                                            <span>
                            <h2 class="d-inline-block" style="font-size: 1.2em; color: white"><span class="ion ion-ios-person"></span> <?= $instruction['passengers']['children'] ?></h2>&nbsp;
                            <h2 class="d-inline-block" style="font-size: 1.2em; color: white"><span class="ion ion-ios-man"></span> <?= $instruction['passengers']['adult'] ?></h2>
                        </span>
                                                            <h2 style="font-size: 1.2em; color: white"><span class="ion ion-ios-card"></span> <?= mb_strtoupper($instruction['payment']['card_type']) ?> <sup>*</sup><?= explode("-",$instruction['payment']['card_number'])[3] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>&nbsp;
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 pt-3 pt-md-5 pl-0 pr-0 pb-md-5 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em">Statistics</span>
                                    </div>
                                    <?php $stat = StatisticsHandler::getProfileStatisticalData($profile['id'])?>
                                    <div class="col-12 pt-4">
                                        <div class="row text-white">
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['distance']) ?> km</span><br />
                                                <span style="font-size: 1em">Distance</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['flights']) ?></span><br />
                                                <span style="font-size: 1em">Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['perfect_flights']) ?></span><br />
                                                <span style="font-size: 1em">Perfect Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= $stat['flights']==0 ? "0.00" : number_format($stat['perfect_flights']/$stat['flights']*100, 2) ?><sup>%</sup></span><br />
                                                <span style="font-size: 1em">Reliability Ratio</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['easy_xp']) ?> xp</span><br />
                                                <span style="font-size: 1em">Easy</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['medium_xp']) ?> xp</span><br />
                                                <span style="font-size: 1em">Medium</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['hard_xp']) ?> xp</span><br />
                                                <span style="font-size: 1em">Hard</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['economy_class_bookings']) ?></span><br />
                                                <span style="font-size: 1em">Economy Class</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['business_class_bookings']) ?></span><br />
                                                <span style="font-size: 1em">Business Class</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['first_class_bookings']) ?></span><br />
                                                <span style="font-size: 1em">First Class</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_asia']) ?></span><br />
                                                <span style="font-size: 1em">Asian Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_europe']) ?></span><br />
                                                <span style="font-size: 1em">European Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_oceania']) ?></span><br />
                                                <span style="font-size: 1em">Oceanian Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_antarctica']) ?></span><br />
                                                <span style="font-size: 1em">Antarctic Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_north_america']) ?></span><br />
                                                <span style="font-size: 1em">N. American Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pl-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['destination_south_america']) ?></span><br />
                                                <span style="font-size: 1em">South Flights</span>
                                            </div>
                                            <div class="col-6 pt-3 pr-0">
                                                <span style="font-size: 2em"><?= StatisticsHandler::showShortenedValue($stat['deadend']) ?></span><br />
                                                <span style="font-size: 1em">Deadend</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pt-3 pt-md-5 pl-0 pr-0 pb-md-5 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em">Achievements</span>
                                    </div>
                                    <div class="col-12 pt-4">
                                        <div class="row">
                                        <?php $achievedAchievements = AchievementHandler::getAllAchievedAchievementsFromDatabaseOfUser($profile['id']) ?>
                                        <?php foreach ($achievedAchievements as $achievement) {
                                            ?>
                                            <div class="col-3 col-md-3 pl-0 pr-0">
                                                <img class="rounded-circle img-fluid" src="<?= $achievement['achieved_file'] ?>" data-toggle="tooltip" title="<?= $achievement['name']." | ".$achievement['desc'] ?>" data-original-title="<?= $achievement['name']." | ".$achievement['desc'] ?>">
                                            </div>
                                        <?php } ?>
                                        <!--<div class="col-3 col-md-2">
                                            <img class="rounded-circle img-fluid" src="/assets/img/achievements/afric000.png">
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <img class="rounded-circle img-fluid" src="/assets/img/achievements/afric000.png">
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <img class="rounded-circle img-fluid" src="/assets/img/achievements/afric000.png">
                                        </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");

            <?php if (isset($_GET['u']) && !empty($_GET['u'])) {?>
            function requestForRelationship(username) {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText=="GOOD") {

                            let colleagueMainButton = document.getElementById("colleagueMainButton");
                            let colleagueSub = document.getElementById("colleagueSub");
                            colleagueMainButton.innerText = "Request Sent";
                            colleagueSub.innerText = "Your colleague relationship has been sent";
                            colleagueMainButton.classList.add("disabled");
                        }
                    }
                };
                xhr.open("post", "fcns/ajax/colleagueRelations/requestColleagueRelationship.php", false);
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xhr.send("u="+username);
            }

            function acceptRequestForRelationship(username) {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText=="GOOD") {
                            window.location.reload(true);
                        }
                    }
                };
                xhr.open("post", "fcns/ajax/colleagueRelations/acceptRequestColleagueRelationship.php", false);
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xhr.send("u="+username);
            }

            function deleteRelationship(username) {
                iziToast.question({
                    overlay: true,
                    drag: false,
                    close: true,
                    title: "Caution (Action Irreversible)",
                    message: 'Are you sure you want to not be colleagues with <?= $profile['full_name']?> (@<?= $profile['username'] ?>)?',
                    backgroundColor: '#ffb8f5',
                    timeout: false,
                    progressBar: false,
                    position: 'center',
                    buttons: [
                        ['<button><b>Yes</b></button>', function (instance, toast, button, e, inputs) {
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                            let xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function () {
                                if (this.readyState == 4 && this.status == 200) {
                                    if (this.responseText=="GOOD") {
                                        window.location.reload(true);
                                    }
                                }
                            };
                            xhr.open("post", "fcns/ajax/colleagueRelations/declineRequestColleagueRelationship.php", false);
                            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                            xhr.send("u="+username);
                        }, false],
                        ['<button><b>No</b></button>', function (instance, toast, button, e, inputs) {

                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, false]
                    ]
                });
            }
            <?php } ?>
        </script>
    </body>
</html>