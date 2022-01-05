const searchBtn = document.querySelector(".img .search button"),
    searchBar = document.querySelector(".img .search input"),
    content = document.querySelector(".sidenav .content-box .content"),
    linkdiv = document.querySelector(".sidenav .content-box .content .friends"),
    chatdiv = document.querySelector("#main");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }
    // lets start ajax
    let xls = new XMLHttpRequest(); //creating XML Object
    xls.open("POST", "search.php", true);
    xls.onload = () => {
        if (xls.readyState === XMLHttpRequest.DONE) {
            if (xls.status === 200) {
                let data = xls.response;
                // console.log(data);
                content.innerHTML = data;
            }
        }
    }
    xls.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xls.send("searchTerm=" + searchTerm);
}


setInterval(() => {
    let xls = new XMLHttpRequest();
    xls.open("GET", "friends.php", true);
    xls.onload = () => {
        if (xls.readyState === XMLHttpRequest.DONE) {
            if (xls.status === 200) {
                let data = xls.response;
                // console.log(data);
                if (!searchBar.classList.contains("active")) {
                    content.innerHTML = data;
                }
            }
        }
    }
    xls.send();
}, 500);