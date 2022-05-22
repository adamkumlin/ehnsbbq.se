let name = document.getElementById("contactName").value;
let email = document.getElementById("contactEmail").value;
let phone = document.getElementById("contactPhone").value;
let message = document.getElementById("contactMessage").value;
// Skapar fyra variabler och kopplar dem till respektive element.

if (name == "" || email == "" || message == "") {
// Om någon variabel är tom.
  
alert("Var snäll fyll i alla nödvändiga fält.");
// Skriver ut ett felmeddelande.
} else if (!name.includes("/^([a-öA-Ö' ]+)$/") {
// Om variebeln inte innehåller bokstäver och/eller mellanslag.
    
alert("Vad snäll använd endast bokstäver och mellanslag i namnfältet.");
// Skriver ut ett felmeddelande.
} else if (!phone.includes("/^[0-9]*$/") {
// Om variabeln inte innehåller siffror.

alert("Var snäll använd endast siffror i telefonfältet.");
// Skriver ut ett felmeddelande.
} else if (message.includes("/(http|https|ftp|mailto)/") {
// Om meddelandet immehåller "http", "https", "ftp" eller "mailto".
    
alert("Var snäll använd inga länkar i meddelandefältet.");
// Skriver ut ett felmeddelande.
}
