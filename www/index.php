




<?php
include 'PhpSerial.php';

$serial = new PhpSerial;
$serial->deviceSet("/dev/ttyACM0");
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");

?>
<html>
<meta charset="UTF-8">
<body>

<center>
</br>
</br>
<img src="image.jpg" alt="House" style="width:300px;height:168px;">


<h1>Dom na wsi</h1><b>Alarm</b>
</br>
</br>

<form method="post" action="alarm.php">
&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="ON" name="rcmd">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="OFF" name="rcmd"><br/>
</br>
</br>
<h1>.........................................</h1>
<?php

$serial->deviceOpen();

sleep(2);
$read=$serial->readPort();
$data=null;
$data=explode(",",$read);


echo 'temperatura : '.$data[0];
echo "</br>";
echo 'wilgotność : '.$data[1];
echo "</br>";
echo 'alarm : '.$data[4];
echo "</br>";

	if($data[3]==1){echo "drzwi otwarte!";}else{echo "drzwi zamknięte";}



$serial->deviceClose();

?>



<br /></center>
</form>
</body>
</html> 
