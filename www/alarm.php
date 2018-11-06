<?php
include 'PhpSerial.php';

$user='7a426caeb7fb4075fc651b9e2bfbdb6c'; // use your md5 string
$pass='91688cff58b0fcea5412a412af436919'; // same as above 



// Let's start the class
//$serial = new PhpSerial;

// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
//$serial->deviceSet("/dev/ttyACM0");

// We can change the baud rate, parity, length, stop bits, flow control
//$serial->confBaudRate(9600);
//$serial->confParity("none");
//$serial->confCharacterLength(8);
//$serial->confStopBits(1);
//$serial->confFlowControl("none");



    /*
    ** Define a couple of functions for
    ** starting and ending an HTML document
    */
    function startPage()
    {

		// Let's start the class
$serial = new PhpSerial;

// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet("/dev/ttyACM0");

// We can change the baud rate, parity, length, stop bits, flow control
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");










        echo "<html>";
        echo '<head><meta charset="UTF-8">';
        print"<title>alarm w lubnowie</title>";
        print"</head>";
        print"<body>";



if (isset($_POST["rcmd"])) {
	$serial->deviceOpen();
$rcmd = $_POST["rcmd"];
echo "<h1><center>alarm is $rcmd</center></h1></br></br></br>";

echo '<center><a href="index.php"><---  back to Dom</a></center>';

sleep(2);
$serial->sendMessage($rcmd);
$serial->deviceClose();

}
    }













    

    function endPage()
    {
        print("</body>\n");
        print("</html>\n");
    }
    /*
    ** test for username/password
    */
    if( ( isset($_SERVER['PHP_AUTH_USER'] ) && (md5( $_SERVER['PHP_AUTH_USER']) ==  $user ) ) AND
      ( isset($_SERVER['PHP_AUTH_PW'] ) && ( md5($_SERVER['PHP_AUTH_PW']) ==$pass )) )
    {
        startPage();

        echo "<h3><center>Zalogowany</center></h3>";


        endPage();
    }
    else
    {
        //Send headers to cause a browser to request
        //username and password from user
        header("WWW-Authenticate: " .
            "Basic realm=\"Dom w Lubnowie - dostęp zastrzeżony\"");
        header("HTTP/1.0 401 Unauthorized");

        //Show failure text, which browsers usually
        //show only after several failed attempts
        print("This page is protected by HTTP " .
            "Authentication.<br>\nUse <b>your login</b> " .
            "for the username, and <b>your password</b> " .
            "for the password.<br>\n");
    }





?>
