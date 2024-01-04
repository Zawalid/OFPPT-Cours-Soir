const container_imgs = document.querySelector("#container_imgs");
const btnAddImg = document.querySelector("#btnAddImg");
btnAddImg.addEventListener("click", () => {
    const input = document.createElement("input");
    input.setAttribute("type", "file");
    input.setAttribute("name", "images[]");
    input.classList.add(
        "w-full",
        "p-3",
        "relative",
        "border-dashed",
        "border-2",
        "hover:border-black",
        "file:mr-4",
        "file:py-2",
        "file:px-4",
        "cursor-pointer",
        "file:absolute",
        "file:top-1/2",
        "file:right-1",
        "file:-translate-y-1/2",
        "file:border-0",
        "file:text-sm",
        "file:font-semibold",
        "file:bg-green-50",
        "file:text-green-700",
        "hover:file:bg-green-700",
        "hover:file:text-green-100",
        "rounded-md",
        "my-2"
    );
    container_imgs.append(input);
});
