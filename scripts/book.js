let today = new Date();
let yyyy = today.getFullYear();
let mm = today.getMonth() + 1;
let dd = today.getDate();
// Hämtar dagens år, månad och dag. Skapar ett nytt objekt titulerat "today".

if (mm < 10) {
    mm = "0" + mm;
}
// Om månadsnumret är mindre än 10 så läggs en 0 till innan så att det blir konsekvent för alla månader.

if (dd < 10) {
    dd = "0" + dd;
}
// Om datumsnumret är mindre än 10 så läggs en 0 till innan så att det blir konsekvent för alla datum.

today = `${yyyy}-${mm}-${dd}`;
// Tilldelar "today" variablerna ovan. Detta blir en variabel som representerar dagens datum i formatet åååå-mm-dd.

document.getElementById("bookDate").setAttribute("min", today);
// Elementet "bookDate" ges attributet "min" variabeln "today":s värde.