// Show login message (JavaScript DOM)
if (typeof loginResult !== "undefined") {
    var msg = document.getElementById("message");
    if (loginResult == "ok") {
        msg.className = "alert alert-success";
        msg.innerHTML = "You logged in successfully!";
    }
    if (loginResult == "wrong") {
        msg.className = "alert alert-danger";
        msg.innerHTML = "Wrong username or password.";
    }
}

// Like button: add 1 to the number and save it
function like(button, id) {
    var number = button.querySelector("span");
    number.innerHTML = Number(number.innerHTML) + 1;
    fetch("like.php?id=" + id);
}
