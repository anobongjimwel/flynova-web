<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <link rel="stylesheet" href="assets/css/accordionReviewerStylesheet.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid " style="min-height: 100vh; background-image: url('assets/img/home_bg/continents/tokyo.jpg'); background-size: 177.77% 100%; background-position: center">
            <div class="row" style="background-color: rgba(255,255,255,0.49)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Asia Reviewer</h2></div>
                    </div>
                </div>
            </div>
            <div class="container pt-5 pb-5">
                <div class="row align-content-center" >
                    <div class="accordion w-100" id="accordionForAntarctica">
                        <?php $ctr = 1; ?>
                        <?php foreach (ReviewerHandler::getCountriesInContinent("Asia") as $country) { ?>
                        <div class="card">
                            <div class="card-header pb-0 pt-0 pl-2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link w-100 h-100 text-left" type="button" data-toggle="collapse" data-target="#country-<?= $ctr ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?= $country['country'] ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="country-<?php echo $ctr?>" class="collapse <?= $ctr==1?"show":"" ?>" data-parent="#accordionForAntarctica">
                                <div class="card-body pb-3 pt-4">
                                    <div class="row">
                                        <?php foreach (ReviewerHandler::getCodesInCountry($country['country']) as $code) { ?>
                                        <div class="col-md-6 col-lg-3 col-12 pb-2 pt-2">
                                            <h3><span class="bg-danger pl-1 pr-1"><?= $code['id'] ?></span></h3>
                                            <h5><?= $code['name'] ?></h5>
                                            <h6><span class="ion ion-ios-pin"></span> <?= $code['location'] ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $ctr+=1; } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- UI Testing Purposes only
        <div class="container pt-5 pb-5">
                <div class="row align-content-center" >
                    <div class="accordion w-100" id="accordionForAntarctica">
                        <div class="card">
                            <div class="card-header pb-0 pt-0 pl-2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link w-100 h-100 text-left" type="button" data-toggle="collapse" data-target="#country-1" aria-expanded="true" aria-controls="collapseOne">
                                        Country Name
                                    </button>
                                </h2>
                            </div>

                            <div id="country-1" class="collapse show" data-parent="#accordionForAntarctica">
                                <div class="card-body pb-3 pt-4">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 col-12 pb-2 pt-2">
                                            <h3><span class="bg-danger pl-1 pr-1">ID</span></h3>
                                            <h5>Airport Name</h5>
                                            <h6><span class="ion ion-ios-pin"></span> Airport Location</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");
        </script>
    </body>
</html>