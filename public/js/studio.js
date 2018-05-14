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

console.ui = function(message, arg1) {
    console.debug("DaPanel:Studio-UI", message, arg1);
}

console.terminal = function(message, arg1) {
    console.debug("DaPanel:Studio-Terminal", message, arg1);
}

function PacketMaker(type) {
    return { t: type };
}

var TerminalManager = {
    execute: function(execute) {
        setTimeout(function() {
            var packet = PacketMaker("terminalexecute");
            packet.execute = execute;
            application.websocket.send(JSON.stringify(packet));
        }, 1);
    },
    output: function(message) {
        setTimeout(function() {
            var c = objectManager.editor.terminal;
            var p = document.createElement("p");
            p.innerText = "@> " + message;
            c.scrollTop = c.scrollHeight;
            c.appendChild(p);
        }, 1);
    }
};

var objectManager = {
    explorer: document.getElementById("explorer"),
    editor: {
        filename: document.getElementById("filename"),
        console: document.getElementById("studio-editor-console"),
        terminal: document.getElementById("console"),
    },
    editors: document.getElementById("editors"),
};

var UIManager = {
    files: {
        lastid: 0,
    },
    setFileName: function(name) {
        objectManager.editor.filename.innerText = name;
    },
    resetWindows: function() {
        for (const element of objectManager.editors.childNodes) {
            if (element.nodeName != "#text") {
                $(element).hide();
            }
        }
    },
    showWindow: function(name) {
        var t = objectManager.editor[name];
        if (t == null) return;
        $(t).show();
    },
    createFile: function(name, onclick) {
        var explorer = objectManager.explorer;
        if (explorer == null) {
            console.error("Explorer: ", explorer);
            console.ui("Failed to create file!");
            return;
        }
        var lastid = UIManager.files.lastid;
        lastid = lastid + 1;
        UIManager.files.lastid = lastid;
        var file = { id: lastid, name: name, li: null, button: null };
        var li = document.createElement("li");
        li.id = "file-" + lastid;
        var button = document.createElement("button");
        li.classList.add("studio-explorer-li");
        button.classList.add("studio-explorer-button");
        button.innerText = name;
        button.onclick = onclick;
        li.appendChild(button);
        file.li = li;
        file.button = button;
        UIManager.files[file.id] = file;
        explorer.appendChild(file.li);
        console.ui("Created File: " + file.id, file);
        return file.id;
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
            text: text,
            fileid: -1,
        };
        fileid = UIManager.createFile(name + ".panel");
        page.fileid = fileid;
        application.pages[page.name] = page;
    }
};

var application = {
    websocket: null,
    pages: {},
    config: {},
    branch: {},
    onload: function() {
        UIManager.resetWindows();
        var c = objectManager.editor.console;
        $(c).find("button[type=button]")[0].onclick = function() {
            var input = $(c).find("input[name=command]")[0];
            var message = input.value;
            input.value = "";
            console.terminal("Execute: " + message);
            var p = document.createElement("p");
            p.innerText = "#> " + message;
            var t = objectManager.editor.terminal;
            t.appendChild(p);
            t.scrollTop = t.scrollHeight;
            TerminalManager.execute(message);
        };
        $(c).find("input[name=command]").keypress(function(e) {
            var key = e.which;
            if (key == 13) {
                var input = $(c).find("input[name=command]")[0];
                var message = input.value;
                input.value = "";
                console.terminal("Execute: " + message);
                var p = document.createElement("p");
                p.innerText = "#> " + message;
                var t = objectManager.editor.terminal;
                t.appendChild(p);
                t.scrollTop = t.scrollHeight;
                TerminalManager.execute(message);
                return false;
            }
        });
    },
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
            application.config[key] = packet.config[key];
        }
        UIManager.createFile(".config");
        console.terminal("Console file created successfully!");
        UIManager.createFile(".console", function() {
            UIManager.resetWindows();
            UIManager.showWindow("console");
            UIManager.setFileName("Console ( Terminal )");
        });
        console.loader("Loading Pages...");
    },
    onpageadded: function(packet) {
        var name = (packet.name == null) ? null : packet.name;
        var title = (packet.title == null) ? null : packet.title;
        var text = (packet.text == null) ? null : packet.text;
        pageManager.create(name, title, text);
        console.page("Loaded Page: " + packet.name);
    },
    onterminaloutput: function(packet) {
        var message = packet.message;
        if (message == null) return;
        console.terminal("Output: " + message);
        TerminalManager.output(message);
    }
};

$(document).ready(function() {
    application.onload();
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
            if (packetType == "terminaloutput") application.onterminaloutput(packet);
        };
        application.websocket.onclose = function(data) {
            console.socket("Disconnected!");
            application.onsocketclose();
        }
    }, 100);
});