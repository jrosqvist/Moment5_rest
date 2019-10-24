# Moment5_rest
Denna webbtjänst ger användaren möjlighet att hämta, lägga till, uppdatera och radera kurser som läses på webbutvecklingsprogrammet på Mittuniversitetet.

I klassen Course finns funktioner som hanterar de olika metoderna som skickas med i HTTP-anropen.

Webbtjänsten finns på denna länk --> https://studenter.miun.se/~joro1803/dt173g/moment5_rest/courselist.php/courses 

Webblänkar för att använda CRUD:

* Lägg till kurs: curl -i -X POST -d '{"code":"DTTEST","name":"Webbutveckling", "progression":"A", "syllabus":"https://www.miun.se"}' https://studenter.miun.se/~joro1803/dt173g/moment5_rest/courselist.php/courses

* Hämta kurser -> curl -i -X GET https://studenter.miun.se/~joro1803/dt173g/moment5_rest/courselist.php/courses

* Uppdatera en kurs: curl -i -X PUT -d ' {"code":"DTtest","name":"Webbutveckling Test", "progression":"A", "syllabus":"https://www.miun.se/"}' https://studenter.miun.se/~joro1803/dt173g/moment5_rest/courselist.php/courses/100

* Ta bort en kurs: curl -i -X DELETE https://studenter.miun.se/~joro1803/dt173g/moment5_rest/courselist.php/courses/100


OBS! I denna version är ännu inte kontrollfunktioner tillagda för inmatat data (som strip_tags och htmlspecialchars). 
Dessa bör läggas till för att undvika att skadlig kod skickas in till databasen, men är inte tillagda för tillfället p.g.a.
att det inte är relevant för uppgiften i sig.
