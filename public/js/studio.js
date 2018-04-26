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
        application.websocket = new WebSocket("ws://dapanel.tk:3020");
        application.websocket.onopen = function() {
            application.onsocketopen();
        };
        application.websocket.onerror = function() {
            application.onsocketerror();
        }
        application.websocket.onmessage = function(data) {
            console.log(data);
        };
        application.websocket.onclose = function() {
            application.onsocketclose();
        }
    }, 100);
});