var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
redis.psubscribe('*');
redis.on('pmessage', function (pattern,channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    console.log('channel: ', channel + '.' + message.event);
    io.emit(channel + '.' + message.event, message);
});
io.on('connection', function (socket) {
    /*var username = socket.handshake.query.username;
    console.log("user-joined", username);*/

   /* io.emit('user-joined', {
        username: username
    });*/

    socket.on('disconnect', function (socket) {
        console.log('user-left');
        /*io.emit('user-left', {
            username: username
        });*/
    });
});
http.listen(3000, function () {
    console.log('Listening on Port 3000');
}); 