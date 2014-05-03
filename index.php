<?php

require 'vendor/autoload.php';

$external_config = parse_ini_file('/repos/config/mandrill.ini');

$mandrill = new Mandrill($external_config['mandrill_key']);

if (!empty($_POST['mandrill_events'])) {	
	$payload = json_decode($_POST['mandrill_events'], true);

	if (!is_array($payload)) {
		exit;
	}

	foreach ($payload as $message) {
		if (isset($message['msg']['raw_msg'])) {
			$params = array(
				'raw_message' => $message['msg']['raw_msg'],
				'to' => array($external_config['to_email']),
			);

			$mandrill->call('/messages/send-raw', $params);
		}	
	}
	
}