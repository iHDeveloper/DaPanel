console.socket = function(message) {
    console.debug("DaPanel:Socket", message);
}

var branchManager = {
    create: function(name) {
        var branch = {
            name: name
        };
        application.branch["_" + branch.name] = branch;
    },
    select: function(name) {
        application.branch.selected = name;
    },
    get: function(name) {
        return application.branch["_" + name];
    }
};

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
        var selected = packet.selected;
        for (var branch of branchs) {
            branchManager.create(branch);
            log("[Branch] Loaded: " + branch);
        }
        branchManager.select(name);
        log("[Branch] Selected: " + selected);
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
        log("[Page] Loaded Page: ");
        log("[Loader] Complete loading all informations!");
    }
};

$(document).ready(function() {
    setTimeout(function() {
        application.onsocketconnect();
        application.websocket = new WebSocket("ws://dapanel.tk:3020");
        application.websocket.onopen = function() {
            console.socket("Connected!");
            application.onsocketopen();
        };
        application.websocket.onerror = function(err) {
            console.socket("Found error!");
            console.socket(err);
            application.onsocketerror();
        }
        application.websocket.onmessage = function(message) {
            console.socket("Message: " + message);
            var packet = JSON.parse(message.data);
            var packetType = packet.t;
            if (packetType == "login") application.onlogin(packet);
            if (packetType == "branchlist") application.onbranchsload(packet);
            if (packetType == "configlist") application.onconfigload(packet);
            if (packetType == "pageinfo") application.onpageadded(packet);
        };
        application.websocket.onclose = function(data) {
            console.socket("Disconnected!");
            application.onsocketclose();
        }
    }, 100);
});