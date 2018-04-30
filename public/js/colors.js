console.debug = function(name, message) {
    console.log("%c[" + name + "] %c", message, 'color:purple', 'color:black');
};