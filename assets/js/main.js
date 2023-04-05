
var deleteLinks = document.querySelectorAll(".js-link-confirm");
for (var i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener("click", function (event) {
        event.preventDefault();
        var choice = confirm("Êtes-vous sur de vouloir supprimer cet élément ?");
        if (choice) {
            window.location.href = this.getAttribute("href");
        }
    });
}