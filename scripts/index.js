let slideIndex = 0;
// Skapar en variabel som ska hålla koll på vilken bild som visas. Den sätts till 0.

showSlides();
// Kör funktionen nedan.

function showSlides() {
  let i;
  // Deklarerar en variabel.

  let slides = document.getElementsByClassName("slideShowSlide");
  let dots = document.getElementsByClassName("progressDot");
  // Kopplar två element till sina respektive variabler.
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  // Skapar en for-loop som gör alla bilder osynliga.
  
  slideIndex++;
  // Adderar 1 till "slideIndex".
  
  if (slideIndex > slides.length) {
  slideIndex = 1
  }
  // När bildspelet är slut så börjar det om genom att sätta "slideIndex" till 1.
  
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" activeDot", "");
  }
  // Adderar en klass till punkterna.
  
  slides[slideIndex-1].style.display = "block";  
  // Visar den bilden som "slideIndex" är lika med.
  
  dots[slideIndex-1].className = dots[slideIndex-1].className + " activeDot";
   // Adderar en klass till punkterna.
  
  setTimeout(showSlides, 3000);
  // Kör funktionen en gång varje 3 sekunder. Varje bild kommer alltså att vara synlig i tre sekunder innan en ny bild visas.
}