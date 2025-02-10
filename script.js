document.addEventListener("DOMContentLoaded", function () {
    const userForm = document.getElementById("userForm");
    const message = document.getElementById("message");
    const uploadForm = document.getElementById("uploadForm");
    const imageList = document.getElementById("imageList");

    userForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;

        fetch("register.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ name, email })
        })
        .then(response => response.json())
        .then(data => {
            message.innerHTML = data.message;
            message.style.color = data.status === "success" ? "green" : "red";
            userForm.reset();
        });
    });

    uploadForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("upload.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                let img = document.createElement("img");
                img.src = data.image;
                img.className = "uploaded-img";
                imageList.prepend(img);
            } else {
                alert(data.message);
            }
        });
    });
});
