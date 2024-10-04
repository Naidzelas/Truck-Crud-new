Run project in terminal

    npm run dev 
    php artisan serve
---
TODOS

- [x] fix isAvailable() to cover all cases for date coverage.
- [ ] add check to isAvailable() if subunit is already planned on other transport.
- [x] add note insert function.
- [ ] refactor namings.
- [ ] sort out laravel backend validation issue with inertiajs.
- [ ] tailwind styling.

---

Užduotis
1. CRUD

Pasidarome sunkvežimių CRUD (trucks). Suvedant leidžiame įvesti šiuos laukus:

Field
Type
Notes
Unit number
String 255, required
Tai sunkvežimio identifikacinis numeriukas, pavyzdžiui A1578, 8050, 147859, B7845 .
Year
Integer, required
Tai sukvežimio pirmos registracijos metai. Leidžiame vesti reikšmes nuo 1900 iki ne toliau nei +5 metai nuo dabar.
Notes
Text, optional
Laisva forma įvedami komentarai. Pavyzdžiui “Available for rent”.



2. Subunit’ai

Kas yra subunit’as

Tuomet padarome, kad truck’ui eitų priskirti subunit’us. Subunit’as - tai “truck’o pavadavimas”. Jei truck’as sulūžo kelyje, tai jį laikinai, kol jį sutaisys, pakeičia kitas truck’as.

Visi truck’ai gali būti subunit’ai vieni kitiems.

Main truck’as - tai tas truck, kurį pavaduoja.
Subunit’as - tai tas truck’as, kuris pavaduoja.

Vartotojas, kai veda naują subunit’ą truck’ui, iškart turi suvesti visus šiuos 4 duomenis, duomenų bazėje tai bus lentelė “truck_subunits”, stulpeliai:
main_truck
subunit
start_date
end_date


Validacijos

Vienas truck’as gali turėti daug subunit’ų, tačiau reikia validuoti, kad:
truck’as pats sau nebūtų uždėtas kaip subunit’as
kad nepersikirstų subunit’ų datos:
jei, pavyzdžiui, truck’as turi subunit’ą datomis 2023 balandžio 1 - 2023 balandžio 15, tai tomis datomis negalime leisti uždėti kito subunit’o
kad jei truck’as yra kaip subunit’as kitam truck’ui, tai kad jam pačiam tuo laikotarpiu neleistų uždėti subunit’o (kad nesigautų, kad truck’ą pavaduoja truck’as, kurį pavaduoja kitas truck’as);
tarkim truck A1578 turi subunit B7845 datomis 2023 balandžio 1 - 2023 balandžio 10
tomis datomis B7845 negali turėti pats sau subunit’o

Techniniai reikalavimai

Projektas kuriamas su Laravel naujausia versija.
Sukurtas projektas turi būti patalpintas savo sukurtoje naujoje Github/Bitbucket viešoje/privačioje repositorijoje.
Tvarkingas ir švarus kodas, kuo paprastesni/plokštesni kodo sprendimai, nedaryti kompleksiškų kodo sprendimų ten, kur jų nereikia.

