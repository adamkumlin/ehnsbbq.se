const toggleHamburgerMenu = document.getElementsByClassName("navToggle")[0];
const navLinks = document.getElementsByClassName("navLinks")[0];
// Skapar två konstanter som kopplas till sina respektive element. De första elementen med klasserna "navToggle" och "navLinks" i varje HTML-fil hittas.

toggleHamburgerMenu.addEventListener("click", () => {
// När elementet klickas på.

    navLinks.classList.toggle("active");
    // Ger .navLinks klassen "active".
});