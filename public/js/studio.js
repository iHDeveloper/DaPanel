console.socket = function(message, arg1) {
    console.debug("DaPanel:Studio-Socket", message, arg1);
}

console.studio = function(message, arg1) {
    console.debug("DaPanel:Studio", message, arg1);
}

console.loader = function(message, arg1) {
    console.debug("DaPanel:Studio-Loader", message, arg1);
}

console.branch = function(message, arg1) {
    console.debug("DaPanel:Branch", message, arg1);
}

console.config = function(message, arg1) {
    console.debug("DaPanel:Configuration", message, arg1);
}

console.page = function(message, arg1) {
    console.debug("DaPanel:Page", message, arg1);
}

var objectManager = {
    explorer: document.getElementById("explorer"),
};

var UIManager = {
    addFile: function(name) {
        var explorer = objectManager.explorer;
    },
};

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

var pageManager = {
    create: function(name, title, text) {
        var page = {
            name: name,
            title: title,
            text: text
        };
        application.pages[page.name] = page;
    }
};

var application = {
    websocket: null,
    pages: {},
    config: {},
    branch: {},
    onsocketconnect: function() {
        console.studio("Loading...");
    },
    onsocketopen: function() {},
    onsocketerror: function() {},
    onsocketclose: function() {},
    oninput: function() {},
    onping: function() {},
    onlogin: function(packet) {
        console.loader("Loading Branchs...");
    },
    onbranchsload: function(packet) {
        var branchs = packet.branchs;
        var selected = packet.selected;
        for (var branch of branchs) {
            branchManager.create(branch);
            console.branch("Loaded: " + branch);
        }
        branchManager.select(name);
        console.branch("Selected: " + selected);
        console.loader("Loading Configurations...");
    },
    onconfigload: function(packet) {
        for (var key in packet.config) {
            console.config("Loaded " + key);
        }
        console.loader("Loading Pages...");
    },
    onpageadded: function(packet) {
        var name = (packet.name == null) ? null : packet.name;
        var title = (packet.title == null) ? null : packet.title;
        var text = (packet.text == null) ? null : packet.text;
        pageManager.create(name, title, text);
        console.page("Loaded Page: " + packet.name);
        console.loader("Successfully! Loaded everything");
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
            console.socket("Error: ", err);
            application.onsocketerror();
        }
        application.websocket.onmessage = function(message) {
            console.socket("Message: ", message);
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