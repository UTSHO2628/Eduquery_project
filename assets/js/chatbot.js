function sendMessage() {
    let userInput = document.getElementById("user-input").value;
    if (userInput.trim() === "") return;

    let chatBox = document.getElementById("chat-box");
    chatBox.innerHTML += "<div><b>You:</b> " + userInput + "</div>";

    fetch("chatbot.php", {
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: "msg=" + encodeURIComponent(userInput)
    })
    .then(res => res.text())
    .then(reply => {
        chatBox.innerHTML += "<div><b>Bot:</b> " + reply + "</div>";
        document.getElementById("user-input").value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    });
}
