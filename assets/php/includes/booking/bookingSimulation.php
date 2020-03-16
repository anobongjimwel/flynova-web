<?php $bookingSimulation = BookingHandler::readBookingSimulation($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])?>
<div class="row">
<?php foreach ($bookingSimulation['booking_details']['booking'] as $booking) { ?>
    <div class="col col-12">
        <span style="font-size: 2em"><?= str_replace("-","<span class='ion ion-ios-airplane'></span>",$booking['route'])?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Origin:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $booking['origin'] ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Origin Country:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $booking['origin_country'] ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Destination:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $booking['destination'] ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Destination Country:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $booking['destination_country'] ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Departure:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?=$booking['departure']==null?"-":date("d F Y, Hi",strtotime($booking['departure']))."H" ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Arrival:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?=$booking['arrival']==null?"-":date("d F Y, Hi",strtotime($booking['arrival']))."H" ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Carrier:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?= CarrierHandler::identifyCarrier($booking['carrier'])==null?"-":CarrierHandler::identifyCarrier($booking['carrier']) ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Seats:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?= (count($booking['seats'])<>0?SeatHandler::reiterateSeatsToString($booking['seats']):"-");?></span>
    </div>
    <div class="col col-12">
        <hr />
    </div>
    <?php } ?>
        <div class="col col-12">
            <span style="font-size: 2em">Passengers</span>
        </div>
        <div class="col col-6 col-md-6">
            <span style="font-size: 1em">Adults:</span>
        </div>
        <div class="col col-md-6">
            <span style="font-size: 1em"><?= $bookingSimulation['passengers']['adults']; ?></span>
        </div>
        <div class="col col-6 col-md-6">
            <span style="font-size: 1em">Children:</span>
        </div>
        <div class="col col-md-6">
            <span style="font-size: 1em"><?= $bookingSimulation['passengers']['children']; ?></span>
        </div>
    <?php $passengerCtr = 0 ?>
    <?php foreach ($bookingSimulation['passengers']['details'] as $passenger) { ?>
        <div class="col col-6 col-md-6">
            <?php if ($passengerCtr==0) {?>
                <span style="font-size: 1em">Details:</span>
            <?php } ?>
        </div>
        <div class="col col-md-6">
            <span style="font-size: 1em"><?php echo "<span style='color: blueviolet'>".$passenger['name'].", ".$passenger['age']."</span><br />".$passenger['nationality']."<br />B: ".$passenger['baggage']." kgs" ?></span>
        </div>
    <?php $passengerCtr+=1; } ?>
    <div class="col col-12">
        <hr />
    </div>
    <div class="col col-12">
        <span style="font-size: 2em">Payment</span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Card Type:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $bookingSimulation['payment']['card_type']==null?"-":$bookingSimulation['payment']['card_type'] ; ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Card Number:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $bookingSimulation['payment']['card_number']==null?"-":$bookingSimulation['payment']['card_number'] ; ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Card Expiry Date:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $bookingSimulation['payment']['expiry_date']==null?"-":$bookingSimulation['payment']['expiry_date'] ; ?></span>
    </div>
    <div class="col col-6 col-md-6">
        <span style="font-size: 1em">Security Code / CVV:</span>
    </div>
    <div class="col col-md-6">
        <span style="font-size: 1em"><?php echo $bookingSimulation['payment']['security_code']==null?"-":$bookingSimulation['payment']['security_code'] ; ?></span>
    </div>
</div>