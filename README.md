# Lounaslippu - Tietokantasovelluksen esittelysivu

HY-TKTL Aineopintojen harjoitustyö: Tietokantasovellus

## Yleisiä linkkejä


[Dokumentaatio.pdf](doc/dokumentaatio.pdf)

[Linkki sovellukseen](http://lounaslippu.jelastic.planeetta.net/)


### Sovelluksen näkymiä
[Sisäänkirjautuminen](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/index.html)

[Rekisteröityminen](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/rekisteroidy.html)

[Muut olemassaolevat näkymät linkkiriviltä](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/omat_tiedot.html)


## Työn aihe

Osakunnan ravintolassa saa opiskelijahintaista ruokaa etukäteen ostetuilla lounaslipuilla.
Nykyään liput käydään erikseen ostamassa toimistosta tiettyinä kellonaikoina, maksukuittia vastaan.
Projektin tarkoituksena on helpottaa lounaslippujen tilaamista.

### Projekti sisältää seuraavia ominaisuuksia

- Käyttäjän rekisteröityminen
 - *Vain rekisteröitynyt käyttäjä voi tilata lippuja*
- Käyttäjien muokkaus ja poistaminen
 - *Käyttäjien roolitus*
    - Normaali käyttäjä
    - Rahastonhoitaja
    - Ylläpitäjä
    - Pääylläpitäjä
- Lippujen ja laskujen generointi
 - *Lippujen numeroilla seurataan lippujen käyttöä*
 - *Käyttäjällä oikeus ostaa vain tietyn verran lippuja*
 - *Laskun generointi ostettujen lippujen perusteella*
   - Lasku tunnistetaan viitenumerolla
- Maksujen tuonti pankkipalvelusta CSV:nä
 - *Kun liput maksettu, ne voi tulostaa järjestelmästä*
- Käytettyjen lippujen kirjaaminen järjestelmään
- Loki palvelussa tehdyistä operaatioista
