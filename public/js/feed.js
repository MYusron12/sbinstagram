document.querySelectorAll(".captions").forEach(function(el) {
    let renderedText = el.innerHTML.replace(
        /#(\w+)/g,
        "<a href='/search?query=%23$1'>#$1</a>"
    );
    el.innerHTML = renderedText;
});

function like(id, type = "POST") {
    let likesCount = 0;
    let el = "";
    if (type == "POST") {
        el = document.getElementById("post-btn-" + id);
        likesCount = document.getElementById("post-likescount-" + id);
    } else {
        el = document.getElementById("comment-btn-" + id);
        likesCount = document.getElementById("comment-likescount-" + id);
    }
    fetch("/like/" + type + "/" + id)
        .then(Response => Response.json())
        .then(data => {
            let currentCount = 0;
            if (data.status == "LIKE") {
                currentCount = parseInt(likesCount.innerHTML) + 1;
                el.innerText = "unlike";
            } else {
                currentCount = parseInt(likesCount.innerHTML) - 1;
                el.innerText = "like";
            }
            likesCount.innerHTML = currentCount;
        });
    return false;
}
