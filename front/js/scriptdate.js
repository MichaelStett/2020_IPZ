

function wyswietlDane()
{
  var data = new Date();
  var godziny = data.getHours();
  var minuty = data.getMinutes();
  var sekundy = data.getSeconds();
  var czas = godziny;
  czas += ((minuty < 10) ? ":0" : ":") + minuty;
  
  var miesiac = data.getMonth() + 1;
  if (miesiac < 9){
    miesiac = "0" + miesiac;
  }
  var dzien = data.getDate();
  if (dzien < 9){
    dzien = "0" + dzien;
  }
  var rok = data.getYear();
  if (rok < 1000){
    rok = 2000 + rok - 100;
  }
  var dzisiaj = dzien + "." + miesiac + "." + rok;

  var dzienTygodnia = data.getDay();
  switch(dzienTygodnia){
    case 0: dzienTygodnia = "Sunday"; break;
    case 1: dzienTygodnia = "Monday"; break;
    case 2: dzienTygodnia = "Tuesday"; break;
    case 3: dzienTygodnia = "Wednesday"; break;
    case 4: dzienTygodnia = "Thursday"; break;
    case 5: dzienTygodnia = "Friday"; break;
    case 6: dzienTygodnia = "Saturday"; break;
  }

  var tekst = "Today is " + dzienTygodnia + ", " + dzisiaj;
  tekst += "<BR>";
  tekst += czas;
  document.getElementById("dataLayer").innerHTML = tekst;
  timerID = setTimeout("wyswietlDane()",1000);
}
