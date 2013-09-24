<?php
set_time_limit(0);
require 'class.PHPWebSocket.php';
function wsOnMessage($clientID, $message, $messageLength, $binary) {
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );
	// check if message length is 0
	if ($messageLength == 0) {
		$Server->wsClose($clientID);
		return;
	}

	//The speaker is the only person in the room. Don't let them feel lonely.
//	if ( sizeof($Server->wsClients) == 1 )
//		$Server->wsSend($clientID, "SERVER SAID:YOU ARE ALONE!");
	else{
		//Send the message to everyone but the person who said it
		foreach ( $Server->wsClients as $id => $client )
			if ( $id != $clientID )
			{	$Server->wsSend($id, "$message"); }
				//$Server->wsSend($id, "Korisnik ciji je ID  $clientID ($ip) rekao je  \"$message\"");
}
}

// when a client connects 
//php.exe C:\xampp\htdocs\FirefoxOS-FastMatrix\project\network\server\server.php
$b=0;
function wsOnOpen($clientID)
{

if (b==0){
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) has connected." );

	//Send a join notice to everyone but the person who joined
	foreach ( $Server->wsClients as $id => $client )
		if ( $id != $clientID )
			$Server->wsSend($id, "Visitor $clientID ($ip) has joined the room.");
			$b=$b+1;
			}
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip($clientID)" ); // posalji prekid prikaza avatara

	//Send a user left notice to everyone in the room
	foreach ( $Server->wsClients as $id => $client )
	$foo = '"{clientID:"$clientID",clientIP:"$ip",kill:"yes"}"';
	$foo = utf8_decode($foo);
		$Server->wsSend($id, $foo);
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
$Server->wsStartServer('192.168.1.72', 9300); // unesi IP servera !!

?>