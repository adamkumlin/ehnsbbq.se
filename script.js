const toggleHamburgerMenu = document.getElementsByClassName("navToggle")[0];
const navLinks = document.getElementsByClassName("navLinks")[0];

toggleHamburgerMenu.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});

let today = new Date();
let yyyy = today.getFullYear();
let mm = today.getMonth() + 1;
let dd = today.getDate();

if (mm < 10) {
    mm = "0" + mm;
}

if (dd < 10) {
    dd = "0" + dd;
}

today = `${yyyy}-${mm}-${dd}`;

document.getElementById("date").setAttribute("min", today);