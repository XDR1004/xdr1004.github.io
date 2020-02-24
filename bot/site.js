var scribe = require('scribe-js')(),
    app = require('express')(),
    server = require('http').Server(app),
    io = require('socket.io')(server),
    requestify = require('requestify');
var schedule = require('node-schedule');
server.listen(2020);

io.sockets.on('connection', function (socket) {
	
	io.sockets.emit('online', Object.keys(io.sockets.adapter.rooms).length);
	console.info('Connected ' + Object.keys(io.sockets.adapter.rooms).length + ' clients');
	
    socket.on('NEWdrop', function(e){
		console.log(e);
		drop(e);
		reg();
    });
	
	socket.on('disconnect', function(){
		console.log('DiSCONNECTED!');
		io.sockets.emit('online', Object.keys(io.sockets.adapter.rooms).length);
		reg();
	});

});


function drop(e)
{
	requestify.post('http://localhost/api/lastOpen', { id: e })
	.then(function (response) {
		data = JSON.parse(response.body);
		io.sockets.emit('loadLiveDrop', data);
		console.log("[!] loadLiveDrop");
	}, 
	function (err) 
	{
		console.log('[!] ERROR WITH loadLiveDrop!');
	});
}


function reg()
{
	requestify.post('http://localhost/api/users', {})
	.then(function(response) {
		data = JSON.parse(response.body);
		io.sockets.emit('reg', data);
		console.log('[!] USERS: ' + data.count);
	},
	function(err)
	{
		console.log('[!] ERROR WITH USERS!');
	});
}