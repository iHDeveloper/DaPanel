console.debug = function(name, message, arg1) {
    console.log("%c[" + name + "] %c", 'color:purple', 'color:black', message, arg1);
};