/**
 * NODE SERVER
 */

console.log('*** BLUESHELL NODE SERVER ***');

// Change to current directory
process.chdir(__dirname);

// CONFIGURATION
var CONFIG = require('config').Blueshell;

// Start socket.io
io = require('socket.io')(CONFIG.port);
console.log('Socket.io started on port ' + CONFIG.port);

// Mysql connection
var mysql      = require('mysql');
var db = mysql.createConnection({
    host     : CONFIG.mysql.host,
    user     : CONFIG.mysql.user,
    password : CONFIG.mysql.password,
    database : CONFIG.mysql.database
});
db.connect(function(err) {
    if (err) {
        console.log('MySQL unable to connect on ' + CONFIG.mysql.host + "/" + CONFIG.mysql.database + " as " + CONFIG.mysql.user + " : " + CONFIG.mysql.password    );
        console.error('MYSQL: error connecting: ' + err.stack);
        closeAndExit();
    }
    console.log('MySQL connected as id ' + db.threadId + " on " + CONFIG.mysql.host + "/" + CONFIG.mysql.database + " as " + CONFIG.mysql.user);
});

// Redis connection
var redis = require("redis");

// Connect to redis for OFFLINE user notifications
var myRedisOffline = redis.createClient(CONFIG.redis.port, CONFIG.redis.host);
console.log('Redis connected on ' + CONFIG.redis.host + ":" + CONFIG.redis.port);
myRedisOffline.on("message", function (channel, message) {
    console.log("myRedisOffline channel " + channel + ": " + message);
    var data = JSON.parse(message);
    data.notified = 0;
    data.create_time = "NOW()";
    var query = db.query("INSERT INTO " + CONFIG.mysql.prefix + "notification SET ?", data, function(err, result) {
        if (err) {
            console.error('MYSQL: error executing query: ' + err.stack);
        } else {
            console.log("MYSQL: last insert id: " + result.insertId);
        }
    });
    console.log(query.sql);
});
var channel = CONFIG.redis.prefix + "OFFLINE";
myRedisOffline.subscribe(channel);
console.log("I have subscribed to " + channel);

// Socket for audit trail
var socketAuditTrail = io.of("/auditTrailComment").on('connection', function (socket) {
    console.info("Connected to /auditTrailComment");
    // socket.emit('news', { hello: 'world' });
    socket.on('auditTrailCommentAdded', function (data) {
        socket.broadcast.emit('refreshAuditTrail', data);
    });
});

// Socket for central notifications
var socketNotifications = io.of("/notifications").on('connection', function (socket) {
    
    // On demand redis connection
    var myRedis = redis.createClient(CONFIG.redis.port, CONFIG.redis.host);
    console.log('Redis connected on ' + CONFIG.redis.host + ":" + CONFIG.redis.port);

    // When a client subscribe to his notifications
    socket.on("subscribeToNotifications", function (data) {

        // First check if are notification with notified = 0, limit to first 3
        var query = "SELECT * FROM " + CONFIG.mysql.prefix + "notification WHERE user_id = " + db.escape(data.user_id) + " AND notified = 0 ORDER BY create_time ASC LIMIT 0,3";
        db.query(query, function(err, rows, fields) {
            if (err) { 
                throw err;
            }
            rows.forEach(function(row) {
                query = "UPDATE " + CONFIG.mysql.prefix + "notification SET notified = 1 WHERE id=" + row.id + " AND user_id = " + db.escape(data.user_id) + " AND notified = 0";
                db.query(query);
                message = JSON.stringify(row);
                socket.emit("receivedNotification", message);
            });
        });

        // Connect to redis on demand
        var channel = data.prefix + data.user_id;
        myRedis.on("message", function (channel, message) {
            console.log(socket.conn.id + " myRedis channel " + channel + ": " + message);
            var data = JSON.parse(message);
            // Save message in notification table
            data.notified = 1;
            data.create_time = "NOW()";
            var query = db.query("INSERT INTO " + CONFIG.mysql.prefix + "notification SET ?", data, function(err, result) {
                if (err) {
                    console.error('MYSQL: error executing query: ' + err.stack);
                } else {
                    console.log("MYSQL: last insert id: " + result.insertId);
                    data.id = result.insertId;
                    message = JSON.stringify(data);
                    socket.emit("receivedNotification", message);
                }
            });
            console.log(query.sql);
        });
        myRedis.subscribe(channel);
        console.log(socket.conn.id + " Subscribed to " + channel);
    });
    
    socket.on('disconnect', function() {
        myRedis.unsubscribe();
        myRedis.quit();
        console.log(socket.conn.id + ' Got disconnect!');
    });

});

// Socket for background job status and progress
/*
var socketBackgroundJob = io.of("/backgroundJob").on('connection', function (socket) {
    var myBackgroundJobUpdateStatusInterval;
    console.info(socket.conn.id + " Connected to /backgroundJob");
    socket.on('backgroundJobStatus', function (data) {
        console.info(socket.conn.id + " Listen to backjob update status for user " + data.user_id);
        function backgroundJobUpdateStatus(socket, data) {
            // console.log(socket.conn.id + " Check status...");
            var query = "SELECT * FROM " + CONFIG.mysql.prefix + "background_job WHERE user_id = " + data.user_id + " AND status = 'COMPLETED'";
            db.query(query, function(err, rows, fields) {
                if (err) { 
                    throw err;
                }
                rows.forEach(function(row) {
                    console.info(socket.conn.id + " Notify user " + data.user_id + " that backjob " + row.id + " of user " + row.user_id + " has been completed");
                    socket.emit('backgroundJobUpdateStatus', row);
                    query = "UPDATE " + CONFIG.mysql.prefix + "background_job SET status = 'ENDED' WHERE id=" + row.id + " AND user_id = " + data.user_id + " AND status = 'COMPLETED'";
                    db.query(query);
                });
            });
        }
        backgroundJobUpdateStatus(socket, data);
        myBackgroundJobUpdateStatusInterval = setInterval(function() { 
            backgroundJobUpdateStatus(socket, data);
        }, 3000);        
    });
    socket.on('disconnect', function() {
        clearInterval(myBackgroundJobUpdateStatusInterval);
        console.log(socket.conn.id + ' Got disconnect!');
    });
});
*/

// Closure
function closeAndExit() {
    console.info("\nClosing");
    console.info("Ended");
    process.exit(0);
}
process.on('SIGTERM', function() {closeAndExit()});
process.on('SIGINT', function() {closeAndExit()});
