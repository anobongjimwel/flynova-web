<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<?php
$profile = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova - Achievements</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2><?= ucfirst($profile['nickname']) ?>'s Achievements</h2></div>
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
                            <div class="col-12 pt-3 pt-md-5 pl-0 pr-0 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em;">Achievements</span>
                                    </div>
                                    <div class="col-12 pt-4 pr-0 pb-5 overflow-hidden">
                                        <div class="row">
                                            <?php $achievements = AchievementHandler::getAllAchievementsFromDatabaseOfUser(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']) ?>
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
                                            <div class="col-12 col-md-6 col-lg-4 pb-3">
                                                <div class="row">
                                                    <div class="col-2 text-right pr-0 pl-0">
                                                        <img src="<?= $file ?>" class="d-inline-block" style="width: 50px;"/>
                                                    </div>
                                                    <div class="col-10 text-white pl-0" style="position: relative; top: -2px; left: 6px;">
                                                        <span style="font-size: 1.25em"><?= $achievement['name'] ?></span><br />
                                                        <span style="font-size: 1em"><?= $achievement['desc'] ?></span><br />
                                                        <?php if ($achievement['achieved']==1) { ?>
                                                            <span style="font-size: 0.8em">ACHIEVED</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
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
        </script>
    </body>
</html>