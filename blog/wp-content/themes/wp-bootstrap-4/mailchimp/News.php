<?php // for MailChimp API v3.0

include('MailChimp.php');  // path to API wrapper downloaded from GitHub

use \DrewM\MailChimp\MailChimp;

function storeAddress() {

    $key = "1d5f7527c340d66451763feecab650d9-us19";
    $list_id = "6dc8dc561b";
	
	/*$nombre = $_POST['nombre'];

    $merge_vars = array(
        'FNAME'     => $nombre
    );*/

    $mc = new MailChimp($key);

    // add the email to your list
    $result = $mc->put('/lists/'.$list_id.'/members/'.md5(strtolower($_POST['email'])), array(
            'email_address' => $_POST['email'],
            /*'merge_fields'  => $merge_vars,*/
        	'status'        => 'subscribed'
        )
    );

    return json_encode($result);

}

// If being called via ajax, run the function, else fail

if ($_POST['ajax']) { 
    echo storeAddress(); // send the response back through Ajax
} else {
    echo 'Method not allowed - please ensure JavaScript is enabled in this browser';
}