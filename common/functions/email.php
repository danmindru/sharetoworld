<?php

/**
 * Send an email message
 * 
 * @param $destination
 * @param $subject
 * @param $message
 * @param $sender
 * @param $reply_to
 * @return unknown_type
 */
function send_email($destination, $subject, $message, $sender = null, $reply_to = null) {
	
	//If sender email address is not specified  default email address is used
    if (is_null($sender)) {
        $sender = SENDER_EMAIL;
    }

    //If replay email address is not specified sender email address is used
    if (is_null($reply_to)) {
        $reply_to = $sender;
    } 

    //Word-wrap message
    //Some email client need this operation to view message properly 
    $message = wordwrap($message, 72);

    //Create message header
    $headers = 'From: ' . $sender. "\n" .
               'Reply-To: ' . $reply_to . "\n" .
               "Content-type: text/plain\n" .
               'X-Mailer: Manager de fotbal';

    return mail($destination, $subject, $message, $headers);
}

?>