# Lounaslippu - Tietokantasovelluksen esittelysivu

HY-TKTL Aineopintojen harjoitustyö: Tietokantasovellus

## Yleisiä linkkejä

[![Code Climate](https://codeclimate.com/github/Kostersson/lounaslippu/badges/gpa.svg)](https://codeclimate.com/github/Kostersson/lounaslippu)

[Dokumentaatio.pdf](doc/dokumentaatio.pdf)

[Linkki sovellukseen](http://lounaslippu.jelastic.planeetta.net/)

käyttäjä: pekka@testi.com salasana:pekka


### Sovelluksen näkymiä
[Sisäänkirjautuminen](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/index.html)

[Rekisteröityminen](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/rekisteroidy.html)

[Muut olemassaolevat näkymät linkkiriviltä](http://ppkostam.users.cs.helsinki.fi/lounaslippu/testinakymat/omat_tiedot.html)


## Työn aihe

Osakunnan ravintolassa saa opiskelijahintaista ruokaa etukäteen ostetuilla lounaslipuilla.
Nykyään liput käydään erikseen ostamassa toimistosta tiettyinä kellonaikoina, maksukuittia vastaan.
Projektin tarkoituksena on helpottaa lounaslippujen tilaamista.

### Projekti sisältää seuraavia ominaisuuksia
* [X] Käyttäjän rekisteröityminen
 * [X] *Vain rekisteröitynyt käyttäjä voi tilata lippuja*
* [X] Käyttäjien muokkaus
* [ ] Käyttäjien poistaminen
 * [ ] *Käyttäjien roolitus*
    - Normaali käyttäjä
    - Rahastonhoitaja
    - Ylläpitäjä
    - Pääylläpitäjä
* [X] Lippujen ja laskujen generointi
 * [X] *Lippujen numeroilla seurataan lippujen käyttöä*
 * [X] *Käyttäjällä oikeus ostaa vain tietyn verran lippuja*
 * [X] *Laskun generointi ostettujen lippujen perusteella*
   * [X] Lasku tunnistetaan viitenumerolla
* [X] Maksujen tuonti pankkipalvelusta CSV:nä
 * [X] *Kun liput maksettu, ne voi tulostaa järjestelmästä*
* [X] Käytettyjen lippujen kirjaaminen järjestelmään
* [ ] Loki palvelussa tehdyistä operaatioista
