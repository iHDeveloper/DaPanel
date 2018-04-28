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
    onlogin: function(packet) {
        log("[Loader] Loading Branchs...");
    },
    onbranchsload: function(packet) {
        log("[Loader] Loaded Branch!");
        var branchs = packet.branchs;
        for (var branch of branchs) {
            log("[Branch] Loaded: " + branch);
        }
        log("[Loader] Loading Configurations...");
    },
    onconfigload: function(packet) {
        log("[Loader] Loaded Configurations");
        for (var key in packet.config) {
            log("[Configurations] Loaded " + key);
        }
        log("[Loader] Loading Pages...");
    },
    onpageadded: function(packet) {
        log("[Loader] Loaded Page: ");
    }
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
        application.websocket.onmessage = function(message) {
            console.log("Receive Message: " + message);
            var packet = JSON.parse(message.data);
            var packetType = packet.t;
            if (packetType == "login") application.onlogin(packet);
            if (packetType == "branchlist") application.onbranchsload(packet);
            if (packetType == "configlist") application.onconfigload(packet);
            if (packetType == "pageinfo") application.onpageadded(packet);
        };
        application.websocket.onclose = function(data) {
            application.onsocketclose();
        }
    }, 100);
});