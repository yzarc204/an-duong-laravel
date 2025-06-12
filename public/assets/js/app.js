// Xử lý dropdown
const avatarButton = document.getElementById("avatarButton");
const avatarDropdown = document.getElementById("avatarDropdown");
// Bật dropdown khi ấn avatar
avatarButton.addEventListener("click", () => {
    avatarDropdown.classList.toggle("hidden");
});
// Đóng dropdown khi nhấp ra ngoài
document.addEventListener("click", (e) => {
    if (
        !avatarButton.contains(e.target) &&
        !avatarDropdown.contains(e.target)
    ) {
        avatarDropdown.classList.add("hidden");
    }
});
