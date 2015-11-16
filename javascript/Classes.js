// Declare a class using a function
function Apple (type) {
    this.type = type;
    this.color = "red";
}

Apple.prototype.getInfo = function() {
    return this.color + ' ' + this.type + ' apple';
};

var apple = new Apple('macintosh');
apple.color = 'reddish';
console.log(apple.getInfo());

//Declare a class using object literals
var apple = {
    type: "macintosh",
    color: "red",
    getInfo: function() {
        return this.color + " " + this.type + ' apple';
    }
};

//Declare a class singleton using a function
var apple = function() {
    this.type = "macintosh";
    this.color = "red";
    this.getInfo = function() {
        return this.color + ' ' + this.type + ' apple';
    };
};