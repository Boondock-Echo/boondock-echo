const topic = authUserId + "/#",
    client = new Paho.MQTT.Client("43.205.51.194", 8083, "clientId_" + Math.random().toString(16).substr(2, 8)),
    previousMessages = [];
function onMessageArrived(e) {
    var n = new Date(),
        t = n.getTime(),
        s = e.payloadString;
    if (s !== previousMessages[0]) {
        previousMessages.unshift({ time: t, content: s }), previousMessages.length > 3 && previousMessages.pop();
        var o = document.getElementById("message-container");
        o.innerHTML = "";
        for (var i = 0; i < previousMessages.length; i++) {
            var a = Math.floor((n.getTime() - previousMessages[i].time) / 6e4),
                r = a > 0 ? a + " min ago" : "just now",
                c = document.createElement("div"),
                u = document.createElement("span");
            (u.textContent = r), (u.style.fontWeight = "bold"), c.appendChild(u), c.appendChild(document.createTextNode(" " + previousMessages[i].content)), o.appendChild(c);
        }
    }
}
client.onMessageArrived = onMessageArrived;
const authenticationOptions = { userName: "blueman", password: "TYgu6fPhoofJ" };
client.connect({
    onSuccess: function () {
        console.log("Connected to MQTT broker"), client.subscribe(topic);
    },
    onFailure: function (e) {
        console.log("Failed to connect: " + e.errorMessage);
    },
    ...authenticationOptions,
});
