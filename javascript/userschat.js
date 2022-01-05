const form = document.querySelector(".typing-area"),
    inputField = document.querySelector(".message"),
    sendBtn = document.querySelector("button"),
    chatBox = document.querySelector(".sidenav .chat .chatting"),
    chatDiv = document.querySelector(".sidenav .chat");

form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = () => {
    let xls = new XMLHttpRequest();
    xls.open("POST", "insert-chat.php", true);
    xls.onload = () => {
        if (xls.readyState === XMLHttpRequest.DONE) {
            if (xls.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xls.send(formData);
}

inputField.onmouseenter = () => {
    chatDiv.classList.add("active");
}

inputField.onmouseleave = () => {
    chatDiv.classList.remove("active");
}

setInterval(() => {
    let xls = new XMLHttpRequest();
    xls.open("POST", "get-chat.php", true);
    xls.onload = () => {
        if (xls.readyState === XMLHttpRequest.DONE) {
            if (xls.status === 200) {
                let data = xls.response;
                // console.log(data);
                chatBox.innerHTML = data;
                if (!chatDiv.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xls.send(formData);
}, 400);

function scrollToBottom() {
    var x = chatDiv.scrollHeight;
    chatDiv.scrollTo(0,x);
}