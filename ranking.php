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
        <title>FlyNova - Ranking</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2>Ranking</h2></div>
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

                                    <div class="col-12 pt-4 pr-0 pb-5 overflow-hidden text-white">
                                        <div class="row pb-4">
                                            <div class="col-md-4 col-6" style="padding-top: 15px;">
                                                <span style="font-size: 2.5em"><?= RankingHandler::ordinal(RankingHandler::getUserPositionInGlobalRanking($profile['id'])) ?></span>
                                                <br />
                                                <span style="font-size: 1em">Global Ranking</span>
                                            </div>
                                            <div class="col-md-4 col-6" style="padding-top: 15px;">
                                                <span style="font-size: 2.5em"><?= RankingHandler::ordinal(RankingHandler::getUserPositionInCountryRanking($profile['id'], $profile['country'])) ?></span>
                                                <br />
                                                <span style="font-size: 1em">Country Ranking</span>
                                            </div>
                                            <div class="col-md-4 col-6" style="padding-top: 15px;">
                                                <span style="font-size: 2.5em"><?= RankingHandler::ordinal(RankingHandler::getUserPositionInColleagues($profile['id'])) ?></span>
                                                <br />
                                                <span style="font-size: 1em">Collegiate Ranking</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-white" style="font-size: 2em;">Top Ranking</span>
                                    </div>
                                    <div class="col-12 pt-4 pr-0 pb-5 overflow-hidden text-white">
                                        <div class="row pb-4 pt-5 pt-md-3">
                                            <div class="col-md-4 col-12 pb-5">
                                                <span style="font-size: 2em">Worldwide</span>
                                                <div class="row mr-md-1 ml-md-1">
                                                <?php foreach (RankingHandler::getGlobalRanking(5) as $rankedIndividual) {
                                                    $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                    ?>
                                                    <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                        <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                        <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                            <?php } ?>
                                                            <div style="width:40px;" class="d-inline-block">
                                                                <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                            </div>
                                                            <div class="d-inline-block" style="">
                                                                <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                            </div>
                                                            <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                        </a>
                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 pb-5">
                                                <span style="font-size: 2em">Country</span>
                                                <div class="row mr-md-1 ml-md-1">
                                                    <?php foreach (RankingHandler::getCountryRanking($profile['country'],5) as $rankedIndividual) {
                                                        $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                        ?>
                                                        <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                            <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                            <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                                <?php } ?>
                                                                <div style="width:40px;" class="d-inline-block">
                                                                    <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                                </div>
                                                                <div class="d-inline-block" style="">
                                                                    <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                    <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                                </div>
                                                                <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                            </a>
                                                        <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 pb-5">
                                                <span style="font-size: 2em">Colleagues</span>
                                                <div class="row mr-md-1 ml-md-1">
                                                    <?php foreach (RankingHandler::getAmongColleaguesRanking($profile['id'],5) as $rankedIndividual) {
                                                        $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                        ?>
                                                        <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                            <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                            <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                                <?php } ?>
                                                                <div style="width:40px;" class="d-inline-block">
                                                                    <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                                </div>
                                                                <div class="d-inline-block" style="">
                                                                    <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                    <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                                </div>
                                                                <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                            </a>
                                                        <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-white" style="font-size: 2em;">Your Ranking and Proximity</span>
                                            </div>
                                            <div class="col-12">
                                                <div class="row pb-4 pt-5 pt-md-3">
                                                    <div class="col-md-4 col-12 pb-5">
                                                        <span style="font-size: 2em">Worldwide</span>
                                                        <div class="row mr-md-1 ml-md-1">
                                                            <?php foreach (RankingHandler::getUserProximityInGlobalRanking(RankingHandler::getUserPositionInGlobalRanking($profile['id']))  as $rankedIndividual) {
                                                                $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                                ?>
                                                                <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                                    <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                                        <?php } ?>
                                                                        <div style="width:40px;" class="d-inline-block">
                                                                            <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                                        </div>
                                                                        <div class="d-inline-block" style="">
                                                                            <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                            <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                                        </div>
                                                                        <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    </a>
                                                                <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12 pb-5">
                                                        <span style="font-size: 2em">Country</span>
                                                        <div class="row mr-md-1 ml-md-1">
                                                            <?php foreach (RankingHandler::getUserProximityInCountryRanking(RankingHandler::getUserPositionInCountryRanking($profile['id'], $profile['country']), $profile['id'], $profile['country']) as $rankedIndividual) {
                                                                $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                                ?>
                                                                <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                                    <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                                        <?php } ?>
                                                                        <div style="width:40px;" class="d-inline-block">
                                                                            <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                                        </div>
                                                                        <div class="d-inline-block" style="">
                                                                            <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                            <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                                        </div>
                                                                        <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    </a>
                                                                <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12 pb-5">
                                                        <span style="font-size: 2em">Colleagues</span>
                                                        <div class="row mr-md-1 ml-md-1">
                                                            <?php foreach (RankingHandler::getUserProximityInColleagues(RankingHandler::getUserPositionInColleagues($profile['id']), $profile['id'], $profile['country']) as $rankedIndividual) {
                                                                $rankedIndividualLevelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP($rankedIndividual['id']));
                                                                ?>
                                                                <div class="col-12 p-2" style="overflow: hidden; white-space: nowrap; <?= $rankedIndividual['id'] == $profile['id'] ? "background-color: gray; border-radius: 10px;" : "; "?>">
                                                                    <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    <a href="profile.php?u=<?= $rankedIndividual['username'] ?>">
                                                                        <?php } ?>
                                                                        <div style="width:40px;" class="d-inline-block">
                                                                            <img src="assets/img/avatars/female_1.png" style="height: 40px;  position: relative; top: -15px;" />
                                                                        </div>
                                                                        <div class="d-inline-block" style="">
                                                                            <h6 class="text-nowrap" style=""><?= $rankedIndividual['full_name'] ?> (@<?= $rankedIndividual['username'] ?>)</h6>
                                                                            <a href="#" class="badge badge-primary"><?= RankingHandler::ordinal($rankedIndividual['rank']) ?></a>&nbsp;<a href="#" class="badge badge-success"><?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP($rankedIndividual['id'])) ?> XP</a>&nbsp;<a href="#" class="badge badge-secondary"><?= $rankedIndividual['country'] ?></a>
                                                                        </div>
                                                                        <?php if ($rankedIndividual['username']!=$_SESSION['username']) {?>
                                                                    </a>
                                                                <?php } ?>
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