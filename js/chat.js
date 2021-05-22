function createChat(to_user, to_fullname, avatar) {
    let temp = '<div class="card-header chat-box-top"><div><img src="'+avatar+'" width="40px" height="40px" style="border-radius: 100%;">'+to_fullname+'</div><button class="btn btn-danger" onclick="closeChat()">Close</button></div>';
    temp += '<div class="card-body align-frame"><div class="chat-wrapper" id="chat-frame' + to_user + '" data-touser="' + to_user + '"></div>';
    temp += '<div class="form-group chat-bottom"><input type="text" id="chat-msg' + to_user + '" placeholder="Your message" autocomplete="off">';
    temp += '<button class="btn btn-success" name="send_chat" id="' + to_user + '">send</button></div></div>';
    document.getElementById("chat-box").innerHTML = temp;
    document.getElementById("chat-box").style.display = "block";
    let buttonArr = document.getElementsByName("send_chat");
    for (let i = 0; i < buttonArr.length; i++) {
        let to_username = buttonArr[i].getAttribute("id");
        document.getElementById("chat-msg"+to_username).addEventListener("keyup",  (e) => {
                e.preventDefault();
                if (e.keyCode === 13) {
                    document.getElementById(to_username).click();
                }
            });
        buttonArr[i].addEventListener("click", () => {
            let chat_msg = document.getElementById("chat-msg" + to_username).value;
            if (chat_msg != "") {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("chat-msg" + to_username).value = "";
                        document.getElementById("chat-frame" + to_username).innerHTML = this.responseText;
                    }
                }
                xhr.open("GET", "./chat_scripts/insert_chat.php?to=" + to_username + "&msg=" + chat_msg, true);
                xhr.send();
            }
        });
    }
}

function fetchChat(to_username) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat-frame" + to_username).innerHTML = this.responseText;
        }
    }
    xhr.open("GET", "./chat_scripts/fetch_chat.php?to=" + to_username, true);
    xhr.send();
}
function updateChat() {
    let chatframeArr = document.getElementsByClassName("chat-frame");
    for (let j = 0; j < chatframeArr.length; j++) {
        let to_user_chat = chatframeArr[j].getAttribute("data-touser");
        fetchChat(to_user_chat);
    }
}
function iniChat(to_user, to_fullname, avatar) {
    createChat(to_user, to_fullname, avatar);
    fetchChat(to_user);
}
setInterval(function () {
    updateChat();
}, 1000);

function closeChat() {
    document.getElementById("chat-box").style.display = "none";
}



