<?php
require_once __DIR__.'/src/FrameBot.php';
$bot = new FrameBot('430836406:AAHgu-VJoLgMTFzQIzBub2qLWjWyNdg2KFE', '@cahsolobot');
function getsource($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
$bot->cmd('/whois', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /whois [domain/ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/whois/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});
$bot->cmd('/geoip', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /geoip [ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/geoip/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});
$bot->cmd('/dnslookup', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /dnslookup [domain/ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/dnslookup/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});
$bot->cmd('/hostsearch', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /hostsearch [domain/ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/hostsearch/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});
$bot->cmd('/nmap', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /nmap [domain/ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/nmap/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});
$bot->cmd('/nping', function ($text) {
    if ($text == '') {
    return Bot::sendMessage('Perintah: /nping [domain/ip]');
    } else {
	$hasil = getsource("http://api.hackertarget.com/nping/?q=".$text);
	}
	return Bot::sendMessage($hasil);
});

// Simple whoami command
$bot->cmd('/whoami', function () {
    // Get message properties
    $message = Bot::message();
    $name = $message['from']['first_name'];
    $userId = $message['from']['id'];
    $text = 'You are <b>'.$name.'</b> and your ID is <code>'.$userId.'</code>';
    $options = [
        'parse_mode' => 'html',
        'reply'      => true,
    ];

    return Bot::sendMessage($text, $options);
});

// Inline
$bot->on('inline', function ($text) {
    $results[] = [
        'type'         => 'article',
        'id'           => 'unique_id1',
        'title'        => $text,
        'message_text' => 'Lorem ipsum dolor sit amet',
    ];
    $options = [
        'cache_time' => 3600,
    ];

    return Bot::answerInlineQuery($results, $options);
});

$bot->run();
