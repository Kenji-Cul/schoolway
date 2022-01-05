const Cardbtn = document.querySelector(".card-container .scholar"),
    form = document.querySelector(".formarea"),
    sendBtn = document.querySelector('.hbutton');
sendBtn.onclick = () => {
    let xls = new XMLHttpRequest();
    xls.open("POST", "insertfriend.php", true);
    xls.onload = () => {
        if (xls.readyState === XMLHttpRequest.DONE) {
            if (xls.status === 200) {
                sendBtn.style.color = "green";
            }
        }
    }
    let formData = new FormData(form);
    xls.send(formData);
}