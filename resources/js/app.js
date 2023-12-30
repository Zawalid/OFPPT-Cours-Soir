import "./bootstrap";

const confirmation = document.querySelector(".confirmation");
const deleteButtons = document.querySelectorAll(".delete");
const cancelDeleteButton = document.querySelector(".cancel_delete");

deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
        const deleteButtonParent = button.parentElement;
        confirmation.classList.remove("hidden");
        confirmation.setAttribute(
            "action",
            `${window.location.origin}${window.location.pathname}/${deleteButtonParent.id}`
        );
    });
});

cancelDeleteButton.addEventListener("click", function () {
    this.closest(".confirmation").classList.add("hidden");
});
