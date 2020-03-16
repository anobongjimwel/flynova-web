<?php $bookingInstructions = json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true)?>
<script>
    <?php
        switch($bookingInstructions['booking_details']['destination_continent']) {
            case "Asia":
                $continent = "bg-asia";
                break;

            case "North America":
                $continent = "bg-northAmerica";
                break;

            case "South America":
                $continent = "bg-southAmerica";
                break;

            case "Africa":
                $continent = "bg-africa";
                break;

            case "Europe":
                $continent = "bg-europe";
                break;

            case "Antarctica":
                $continent = "bg-antarctica";
                break;

            case "Oceania":
                $continent = "bg-oceania";
                break;
        }
    ?>
    document.getElementById("bookingContainer").classList.add("<?= $continent ?>");
</script>
<div class="row">
    <div class="col-12">
        <span style="font-size: 2em">Booking Details</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Type:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['type'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Origin:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['origin'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Origin Country:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['origin_country'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Destination:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['destination'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Destination Country:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['destination_country'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Class:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['booking_details']['class'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Category:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= ucfirst($bookingInstructions['booking_details']['category']) ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Destination Continent:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= ucfirst($bookingInstructions['booking_details']['destination_continent']) ?></span>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-12">
        <span style="font-size: 2em">Passengers</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Adults:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['passengers']['adult'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Children:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['passengers']['children'] ?></span>
    </div>
    <?php $passengerCtr = 0?>
    <?php foreach ($bookingInstructions['passengers']['details'] as $passenger) {?>
    <div class="col-6">
        <?php if ($passengerCtr==0) {?><span style="font-size: 1em">Name:</span><?php } ?>
    </div>
    <div class="col-6">
    <span style="font-size: 1em; font-weight: 600">
        <?php echo "<span style='color: blueviolet'>".$passenger['name'].", ".$passenger['age']."</span><br />".$passenger['nationality']."<br />"."B: ".$passenger['baggage']." kgs." ?>
    </span>
    </div>
    <?php $passengerCtr+=1; } ?>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-12">
        <span style="font-size: 2em">Payment</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Card Type:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= ucfirst($bookingInstructions['payment']['card_type']) ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Card Number:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['payment']['card_number'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Expiry Date:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['payment']['expiry_date'] ?></span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em">Security Code:</span>
    </div>
    <div class="col-6">
        <span style="font-size: 1em; font-weight: 600"><?= $bookingInstructions['payment']['security_code'] ?></span>
    </div>
</div>