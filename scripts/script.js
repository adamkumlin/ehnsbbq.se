const toggleHamburgerMenu = document.getElementsByClassName("navToggle")[0];
const navLinks = document.getElementsByClassName("navLinks")[0];
// Skapar två konstanter som kopplas till sina respektive element. De första elementen med klasserna "navToggle" och "navLinks" i varje HTML-fil hittas.

toggleHamburgerMenu.addEventListener("click", () => {
// När elementet klickas på.

    navLinks.classList.toggle("active");
    // Ger .navLinks klassen "active".
});

window.addEventListener('load', function(){
    window.cookieconsent.initialise({
     revokeBtn: "<div class='cc-revoke'></div>",
     type: "opt-in",
     theme: "classic",
     palette: {
         popup: {
             background: "#000",
             text: "#fff"
          },
         button: {
             background: "#fd0",
             text: "green"
          }
      },
     content: {
         message: "Den här webbplatsen använder kakor för att kontaktformuläret ska förbli säkert.",
         allow: "Det är okej",
         href: "http://ehnsbbq.se/privacy.html"
      },
      onInitialise: function(status) {
        if(status == cookieconsent.status.allow) scripts();
      },
      onStatusChange: function(status) {
        if (this.hasConsented()) scripts();
      }
    })
  });
  
  function scripts() {
  
     // Paste here your scripts that use cookies requiring consent. See examples below
  
     // Google Analytics, you need to change 'UA-00000000-1' to your ID
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-00000000-1', 'auto');
        ga('send', 'pageview');
  
  
     // Facebook Pixel Code, you need to change '000000000000000' to your PixelID
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '000000000000000');
        fbq('track', 'PageView');
  
  }