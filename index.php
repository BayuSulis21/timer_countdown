<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="timer/jquery.plugin.min.js"></script>
  <script src="timer/jquery.countdown.min.js"></script>
	<style>
		#timer_place {
			margin: 0 auto;
			text-align: center;
		}

		#counter {
			border-radius: 7px;
			border: 2px solid gray;
			padding: 7px;
			font-size: 2em;
			font-weight: bolder;
		}
	</style>
	<script type="text/javascript">
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
	</script>
	<?php
	session_start();
    
	if (empty($_SESSION["waktu_start"])) {
		$_SESSION["waktu_start"] = time();
		$lewat = 0;
	} else {
		$lewat = time() - $_SESSION["waktu_start"];
	}
	//timer 15menit
	$max_timer =1.2*60;
	?>
</head>
<body>

<div class="container mt-3">
  <h2>TIMER COUNTDOWN</h2>
  <div class="card">
    <div class="card-body">
		<div class="col-sm-6">
    		<h4 class="page-title">Waktu</h4>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-right">
				<div id="clock"></div>
			</ol>
		</div>
		<div class="col-sm-6">
    		<h4 class="page-title">Countdown</h4>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-right">
				<div id="counter"></div>
			</ol>
		</div>

	</div>
	<a href="destroy.php">Destroy Session</a>
  </div>
</div>
<script type="text/javascript">
    function waktuHabis() {
        alert('Waktu Anda telah habis, Jawaban anda akan disimpan secara otomatis.');
        var formSoal = document.getElementById("formSoal");
        formSoal.submit();
    }

    function hampirHabis(periods) {
        if ($.countdown.periodsToSeconds(periods) == 60) {
            $(this).css({
                color: "red"
            });
        }
    }
    $(function() {
        var waktu = <?= $max_timer ?>;
        var sisa_waktu = waktu - <?= $lewat ?>;
        var longWayOff = sisa_waktu;
        console.log(<?= $lewat ?>);
        $("#counter").countdown({
            until: longWayOff,
            compact: true,
            onExpiry: waktuHabis,
            onTick: hampirHabis
        });
    });
</script>
</body>
</html>
