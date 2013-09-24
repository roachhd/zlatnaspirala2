 //////////////////
 //make id network
 //////////////////
var ID_NET = Math.random().toFixed(2);
var Net_id = new Array();
var Net_x = new Array();
var Net_y = new Array();
var Net_z = new Array();
 
 //////////////
 
 	var Server;

		function log( text ) {
		 
		}

		function send( text ) {
			Server.send( 'message', text );
		}

	 
			log('Connecting...');
			Server = new FancyWebSocket('ws://192.168.1.72:9300');// adresa servera 

		 
				//	send( this.value );
 

			//Let the user know we're connected
			Server.bind('open', function() {
				log( "Connected." );
			});

			//OH NOES! Disconnection occurred.
			Server.bind('close', function( data ) {
				log( "Disconnected." );
				 try{
				var KILLTOKEN = JSON.parse(data);
	              if (KILLTOKEN.kill = "yes"){
				     Net_x.splice(Net_x.indexOf(TOKEN.id),1);
					 Net_y.splice(Net_y.indexOf(TOKEN.id),1);
					 Net_z.splice(Net_z.indexOf(TOKEN.id),1);
				  console.log('ok');
				  }
				
				
				}catch(e){
				console.log('greska');
				}
				
				
				
			});

			//Log any messages sent from server
			Server.bind('message', function( payload ) {
				log( payload );
				
 console.log('LOG>>>>>>'+payload);	
 
	   try{
	   var TOKEN = JSON.parse(payload);
	   }catch(e){
	   console.log('is not a token');
	   }
	   finally
	   {
	   console.log ('FINAL');
	   
	   }
		
           if  (TOKEN != null ){ 
		   
		   if (Net_id.indexOf(TOKEN.id) == null) {  
			   Net_id.push(TOKEN.id);
			   Net_x.push(TOKEN.x);
			   Net_y.push(TOKEN.y);
			   Net_z.push(TOKEN.z);
			   console.log("New player");
		   } else {
		   //update
		   Net_x.splice(Net_x.indexOf(TOKEN.id),1,  TOKEN.x);
		   Net_y.splice(Net_y.indexOf(TOKEN.id),1,  TOKEN.y);
		   Net_z.splice(Net_z.indexOf(TOKEN.id),1,  TOKEN.z);
		   }
		   
		   }
		   
			});
		

			Server.connect();
	 
 
 ///////////////
   
  
 

 