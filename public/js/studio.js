var log = console.log;
var application = {
    websocket: null,
    pages: {},
    config: {},
    branch: {},
    onsocketconnect: function() {
        log("Connecting...");
    },
    onsocketopen: function() {
        log("Connected!");
    },
    onsocketerror: function() {
        log("Failed to connect!");
    },
    onsocketclose: function() {
        log("Disconnected!");
    },
    oninput: function() {},
    onping: function() {},
    onlogin: function() {},
};

$(document).ready(function() {
    setTimeout(function() {
        application.onsocketconnect();
        application.websocket = new WebSocket("ws://localhost:3020");
        application.websocket.onopen = function() {
            application.onsocketopen();
        };
        application.websocket.onerror = function(err) {
            log(err);
            application.onsocketerror();
        }
        application.websocket.onmessage = function(data) {
            console.log(data);
        };
        application.websocket.onclose = function(data) {
            application.onsocketclose();
        }
    }, 100);
});