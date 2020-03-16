<nav id="onlyNavbar" class="navbar text-white" style="background-color: rgba(108,117,125,0.95); z-index: 9999">
    <div class="container">
        <?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {?>
        <a class="navbar-brand text-center"><img src="assets/img/logos/fn-logo-small-light.png" style="cursor: pointer; height: 40px;" onclick="location.href='index.php'"/></a>
        <ul class="nav mr-md-2">
            <li class="navbar-text mr-2">
                <button class="btn btn-sm btn-danger" style="border-radius: 10px" data-toggle="collapse" data-target="#rightNav" onclick="document.getElementById('rightLogin').classList.remove('show')">
                    <i class="ion ion-ios-options" style="font-size: 1.75em" data-tooltip="tooltip" title="Menu"></i>
                </button>
            </li>
            <li class="navbar-text">
                <button class="btn btn-sm btn-danger" style="border-radius: 10px 0 0 10px" data-toggle="collapse" data-target="#rightLogin" onclick="document.getElementById('rightNav').classList.remove('show')">
                    <i class="ion ion-ios-log-in" style="font-size: 1.75em" data-tooltip="tooltip" title="Log In"></i>
                </button>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="rightNav">
            <hr />
            <div class="row">
                <div class="col-12 col-md-4">
                    <ul class="navbar-nav">
                        <li class="navbar-item">
                            <h3>Menu</h3>
                            <span style="font-size: 1.5em" onclick="location.href='index.php'">
                                        <i class="ion ion-ios-home"></i> Home
                                    </span><br />
                            <span style="font-size: 1.5em" onclick="location.href='about-us.php'">
                                        <i class="ion ion-ios-people"></i> About Us
                                    </span><br />
                            <span style="font-size: 1.5em" onclick="location.href='contact-us.php'">
                                        <i class="ion ion-ios-call"></i> Contact Us
                                    </span>
                        </li>
                    </ul>
                    <br />
                </div>
                <div class="col-12 col-md-4">
                    <ul class="navbar-nav">
                        <li class="navbar-item">
                            <h3>Terms </h3>
                            <span style="font-size: 1.5em" onclick="location.href='privacy-policy.php'">
                                        <i class="ion ion-ios-list"></i> Privacy Policy
                                    </span><br />
                            <span style="font-size: 1.5em" onclick="location.href='termsAndAgreements.php'">
                                        <i class="ion ion-ios-list"></i> Terms and Agreements
                                    </span><br />
                            <span style="font-size: 1.5em" onclick="location.href='FAQs.php'">
                                        <i class="ion ion-ios-list"></i> Frequently Asked Questions
                                    </span>
                        </li>
                    </ul>
                    <br />
                </div>
                <div class="col-12 col-md-4 text-right d-none d-md-inline-block">
                    <img src="assets/img/icons/128px.png" style="width: 64px"/>
                    <br />
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="rightLogin">
            <hr />
            <ul class="nav navbar-nav">
                <div class="row">
                    <div class="d-none d-md-inline-block col-md-6">
                        <!--
                        <li class="nav-text" style="cursor: default">
                            <h3>Benefits of Being a Member</h3>
                        </li>
                        <li class="nav-text" style="cursor: default">
                            <h5>Lorem Ipsum 1</h5>
                            <h6>Testing 123 Testing 123</h6>
                            <br/>
                        </li>
                        <li class="nav-text" style="cursor: default">
                            <h5>Lorem Ipsum 1</h5>
                            <h6>Testing 123 Testing 123</h6>
                            <br />
                        </li>
                        <li class="nav-text" style="cursor: default">
                            <h5>Lorem Ipsum 1</h5>
                            <h6>Testing 123 Testing 123</h6>
                            <br />
                        </li>
                        -->
                        <br />
                    </div>
                    <div class="col-12 col-md-6">
                        <li class="nav-text" style="cursor: default">
                            <h3>Log In</h3>
                        </li>
                        <li class="nav-text" style="cursor: default">
                            <form action="javascript:return false;" onsubmit="return login();">
                                <div class="loginMessage">

                                </div>
                                <div class="form-group">
                                    <label for="nav_username">Username</label>
                                    <input type="text" class="form-control" id="nav_username" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="nav_password">Password</label>
                                    <input type="password" class="form-control" id="nav_password" placeholder="Enter password">
                                </div>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary"><span class="ion ion-ios-log-in"></span> Submit</button>
                                    <button type="submit" class="btn btn-secondary"><span class="ion ion-ios-close"></span> Clear</button>
                                </div>
                                <br /><br />
                                If you do not have an account yet, <a href="register.php">register here</a>.
                            </form>
                        </li>
                        <br />
                    </div>
                </div>

            </ul>
        </div>

        <?php } else { ?>
        <?php $levelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])) ?>

        <a class="navbar-brand text-center"><img src="assets/img/icons/32px.png" style="cursor: pointer;" onclick="location.href='dashboard.php'"/></a>
        <ul class="nav mr-auto" data-target="#profileNav" data-toggle="collapse" style="cursor: pointer"  onclick="document.getElementById('rightNav').classList.remove('show')">
            <li class="navbar-text">
                <img src="assets/img/avatars/female_1.png" style="height: 40px; position: relative; top: 2px; left: -5px;"/>
            </li>
            <li class="navbar-text" style="max-width: 70%; overflow: hidden;">
                    <span class="d-block overflow-hidden" style="white-space: nowrap; font-size: 1em;"><?= ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['nickname'] ?></span>
                    <span class="d-block" style="font-size: 0.75em">Level <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['level'] ?>, <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['name'] ?></span>
            </li>
            <?php $achievements = AchievementHandler::getFourMostAchievedAchievementsFromDatabaseOfUser(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']) ?>
            <?php foreach ($achievements as $achievement) {
            switch ($achievement['achieved']) {
                case 1:
                    $file = $achievement['achieved_file'];
                    break;

                case 0:
                    $file = $achievement['unachieved_file'];
                    break;
            }
            ?>
            <li class="navbar-text ml-3 d-none d-md-inline-block">
                <img src="<?= $file ?>" style="height: 40px; position: relative; top: 2px; left: -5px;" data-tooltip="tooltip" title="<?= $achievement['name']." - ".$achievement['desc']?>" data-placement="bottom"/>
            </li>
            <?php } ?>
            <!-- UI Testing Purposes only
            <li class="navbar-text ml-3 d-none d-md-inline-block">
                <img src="assets/img/achievements/asia0001.png" style="height: 40px; position: relative; top: 2px; left: -5px;"  data-tooltip="tooltip" title="Achievement Name - Achievement Description" data-placement="bottom"/>
            </li>
            -->

        </ul>
        <ul class="nav mr-md-2">
            <li class="navbar-text mr-2 d-none d-lg-inline-block">
                <button class="btn btn-sm btn-danger" style="border-radius: 10px">
                    <i class="ion ion-ios-airplane" style="font-size: 1.75em" data-tooltip="tooltip" title="Flights" data-placement="bottom"></i> <span data-tooltip="tooltip" title="Flights" data-placement="bottom" style="font-size: 1em; position: relative; top: -4px;"></span>
                </button>
            </li>
            <li class="navbar-text mr-2 d-none d-lg-inline-block">
                <button class="btn btn-sm btn-danger" style="border-radius: 10px" data-toggle="collapse" data-target="#profileNav" onclick="document.getElementById('rightNav').classList.remove('show')">
                    <i class="ion ion-ios-notifications" style="font-size: 1.75em" data-tooltip="tooltip" title="Notifications" data-placement="bottom"></i><span data-tooltip="tooltip" title="Flights" data-placement="bottom" style="font-size: 1em; position: relative; top: -4px;"></span>
                </button>
            </li>
            <li class="navbar-text">
                <button class="btn btn-sm btn-danger" style="border-radius: 10px 0 0 10px" data-toggle="collapse" data-target="#rightNav" onclick="document.getElementById('profileNav').classList.remove('show')">
                    <i class="ion ion-ios-options" style="font-size: 1.75em" data-tooltip="tooltip" title="Menu" data-placement="bottom"></i>
                </button>
            </li>
        </ul>

        <div class="collapse navbar-collapse" id="profileNav">
            <hr />
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="row m-0">
                        <div class="col-12 pb-5 pb-lg-0 pl-3 pl-md-4">
                            <ul class="nav navbar-nav">
                                <li class="nav-text">
                                    <h3>Profile</h3>
                                </li>
                                <li class="navbar-item">
                                    <div class="row">
                                        <div class="col-2 col-lg-1 text-right">
                                            <img src="assets/img/avatars/female_1.png" class="d-inline-block"  style="height: 40px; position: relative; top: 2px; left: -7px;"/>
                                        </div>
                                        <div class="col-10 col-lg-11 m-0">
                                            <span class="d-block overflow-hidden" style="white-space: nowrap; font-size: 1em;"><?= ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['nickname'] ?></span>
                                            <span class="d-block" style="font-size: 0.75em">Level <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['level'] ?>, <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['name'] ?></span>
                                            <div class="progress mt-2 progress-bar-striped" >
                                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= number_format(LevelHandler::getCurrentBaseLevel($levelRange['min'], LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']), $levelRange['max'], LevelHandler::LEVEL_PERCENTAGE), 2) ?>%" aria-valuenow="<?= LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']); ?>" aria-valuemin="<?= $levelRange['min'] ?>" aria-valuemax="<?= $levelRange['max'] ?>">
                                                    <span style="color: black; font-weight: 600;" class="text-white">
                                                        &nbsp;<?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))?><sup>xp</sup>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 pl-3 pl-md-4">
                            <ul class="navbar-nav">
                                <li class="nav-text">
                                    <h3>Achievements</h3>
                                </li>
                                <li class="navbar-nav">
                                    <?php $achievements = AchievementHandler::getFiveMostAchievedAchievementsFromDatabaseOfUser(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']) ?>
                                    <?php foreach ($achievements as $achievement) {
                                        switch ($achievement['achieved']) {
                                            case 1:
                                                $file = $achievement['achieved_file'];
                                                break;

                                            case 0:
                                                $file = $achievement['unachieved_file'];
                                                break;
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-2 col-lg-1 text-right m-0">
                                            <img src="<?= $file ?>" style="height: 50px; position: relative; top: 2px; left: -15px;"/>
                                        </div>
                                        <div class="col-9 col-lg-11">
                                            <span class="d-block overflow-hidden" style="white-space: nowrap; font-size: 1em;"><?= $achievement['name'] ?></span>
                                            <span class="d-block" style="font-size: 0.75em"><?= $achievement['desc'] ?></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <!-- UI Testing Purposes only
                                    <div class="row">
                                        <div class="col-2 col-lg-1 text-right m-0">
                                            <img src="assets/img/achievements/swaterb1.png" style="height: 50px; position: relative; top: 2px; left: -15px;"/>
                                        </div>
                                        <div class="col-9 col-lg-11">
                                            <span class="d-block overflow-hidden" style="white-space: nowrap; font-size: 1em;">Achievement Name</span>
                                            <span class="d-block" style="font-size: 0.75em">Achievement Description</span>
                                        </div>
                                    </div>
                                    -->
                                </li>
                                <br/>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-12 pl-4 pl-md-4">
                    <ul class="nav navbar-nav">
                        <li class="nav-text">
                            <h3>Notifications</h3>
                        </li>
                        <li class="navbar-text">
                            No new notifications
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="rightNav">
            <hr />
            <ul class="nav navbar-nav">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <li class="nav-text">
                            <h3>Settings</h3>
                        </li>
                        <li class="nav-text">
                            <span>
                            <h5>Animation Mode </h5><sup class="badge small badge-danger"><font style="font-size: 1em">Coming Soon</font></sup>
                                </span>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="system-animated" value="option1" checked>
                                        <label class="form-check-label" for="system-animated">
                                            <font style="font-size: 1em">Animated Mode</font>
                                            <font style="font-size: 0.75em"><br />Better used when using the Personal Computer (PC), Mac, iPad, high end tablets or phones. Enables all animations and sounds at an expense of being resource extensive. Recommended to be used when in WiFi connection.</font>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="system-unanimated" value="option1" checked>
                                        <label class="form-check-label" for="system-unanimated">
                                            <font style="font-size: 1em">Simplified Mode</font>
                                            <font style="font-size: 0.75em"><br />Better used when using low-end phones or tablets. Minimizes animations and sounds providing a more focused environment, less obtrusive interactive system actions and less resouce extensive experience. Recommended to be used also when using mobile data.</font>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <br />
                    </div>
                    <div class="col-12 col-md-3">
                        <li class="nav-text">
                            <h3>Menu</h3>
                        </li>
                        <li class="nav-text" onclick="location.href='index.php';">
                            <h5><i class="ion ion-ios-home"> </i> Home</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='about-us.php';">
                            <h5><i class="ion ion-ios-people"> </i> About Us</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='contact-us.php';">
                            <h5><i class="ion ion-ios-contact"> </i> Contact Us</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='privacy-policy.php';">
                            <h5><i class="ion ion-ios-list"> </i> Privacy Policy</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='termsAndAgreements.php';">
                            <h5><i class="ion ion-ios-list"> </i> Terms and Agreements</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='FAQs.php';">
                            <h5><i class="ion ion-ios-list"> </i> FAQs</h5>
                        </li>
                        <br />
                    </div>
                    <div class="col-12 col-md-3">
                        <li class="nav-text">
                            <h3>Profile Actions</h3>
                        </li>
                        <li class="nav-text" onclick="location.href='dashboard.php';">
                            <h5><i class="ion ion-ios-clipboard"> </i> Dashboard</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='profile.php';">
                            <h5><i class="ion ion-ios-contact""> </i> Profile</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='notifications.php';">
                            <h5><i class="ion ion-ios-notifications"> </i> Notifications</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='achievements.php';">
                            <h5><i class="ion ion-ios-trophy"> </i> Achievements</h5>
                        </li>
                        <li class="nav-text" onclick="location.href='ranking.php';">
                            <h5><i class="ion ion-ios-trending-up"> </i> Ranking</h5>
                        </li>
                        <li class="nav-text" onclick="logout();">
                            <h5><i class="ion ion-ios-log-out"></i> Log Out</h5>
                        </li>
                        <br />
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <?php } ?>
</nav>
