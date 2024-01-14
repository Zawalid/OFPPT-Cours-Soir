const container_imgs = document.querySelector("#container_imgs");
const btnAddImg = document.querySelector("#btnAddImg");
let i =1
btnAddImg.addEventListener("click", () => {
    const div = document.createElement("div");
    div.classList.add('rounded-md' ,'border', 'border-black', 'relative','bg-gray-50', 'p-4' ,'shadow-md', 'w-36')
    div.innerHTML = `
                        <label for="upload${i}" class="flex flex-col items-center gap-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-black" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <input id='upload${i}' type="file" name='images[]' class="hidden upload" />
                                <span class="text-gray-600 font-medium">Upload file</span>
                        </label>
                        <i class="fa-solid  fa-delete-left text-red-500 absolute removeFile cursor-pointer rounded-2xl m-1 px-1 right-0 top-0 hover:text-black hover:scale-110"></i>
                    `;
    container_imgs.appendChild(div);
    www()
    i++

});
function www() {
    let uploads = document.querySelectorAll(".upload");
        uploads.forEach((up) => {
        up.addEventListener("change", (e) => {
        up.nextElementSibling.textContent = e.target.value.split("\\").pop();
    });
    });
    let remove = document.querySelectorAll(".removeFile");
    remove.forEach(e => {
    e.addEventListener('click', e => {
    e.target.parentElement.remove();
}) 
})


 }
www()