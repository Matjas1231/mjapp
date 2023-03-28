# Mjapp

Aplikacja, której początkowym założeniem było usprawnienie zarządzania informacjami opracownikach (tj. w jakim są dziale, jakie mają przypisane do siebie komputery itp.).

Dane do logowania na konto admnistratora to
- Login / Email: **admin@admin.pl**
- Hasło: **zaq1@WSX**

Wersja live aplikacji można zobaczyć pod [tym adresem](https://mjapp.matijas.vxm.pl/) (uwaga, w związku z robudową, nie zawsze wszystko może działać)

---
## Spis treści
- [Ogólne informacje](#ogólne-informacje)
- [Stack](#technologie)
- [Uruchomienie projektu](#uruchomienie-projektu)
- [Customowe komendy i harmonogram zadań](#customowe-komendy-i-harmonogram-zadań)
    - [Customowe komendy](#customowe-komendy)
    - [Harmonogram zadań](#harmonogram-zadań)
- [REST Api](#dostęp-do-rest-api)
- [Observer i kolejki](#konfiguracja-observera-i-kolejek)
---
## Ogólne informacje
Projekt zawiera:
1. Autoryzację użytkowników
1. CRUD z walidacją danych - `Zarządzanie zasobami`
1. Podłączone zewnętrzne API:
    - Pobieranie aktualnych kursów walut z NBP
    - Sprawdzanie firmy w VIES
    - Tłumaczenie tekstu w Deepl
1. Wystawione jest REST API
1. Sklep - `w budowie`
1. Customowe komenda do pobierania kursów walut - `php artisan currency:download`
1. Observera:
    - Tworzy kolejkę przy pobraniu walut
    - Kolejka wysyła wiadomość mail

---

## Technologie
1. PHP >= 8.0
2. Laravel >= 9.0
3. npm >= 6.14
4. node >= 14.16
5. composer >= 2.2
6. Boostrap 5

---

## Uruchomienie projektu
W celu uruchomienia projektu lokalnie należy:
1. Git clone
1. Composer install
1. npm install
1. npm run dev
1. php artisan key:generate
1. php artisan migrate
1. php artisan db:seed
1. php artisan serve

---

## Customowe komendy i harmonogram zadań
### Customowe komendy:
Dostępne komendy

1. **php artisan currency:download** - Pobiera informacji o kursie wymiany walut

### Harmonogram zadań
Uruchomienie komendy **php artisan schedule:work** sprawia, że aplikacja będzie pobierać co minutę informacje o kursie walut.

Uruchomienie komendy **php artisan schedule:run** uruchamia to zadanie tylko raz

## Dostęp do REST Api
Routy znajdują się w  routes\api.php.

Routa: /api/computers

## Konfiguracja observera i kolejek
W aplikacji znajduje sie jeden observer, który nasłuchuje pobierania kursów walut. Żeby go uruchomić należy:
1. Skonfigurować SMPT w pliku .env
1. W pliku app\Observers\NoteObserver.php wpisać adres email, na który chcemy wysłać informacje.
1. Uruchomić komendę: **php artisan queue:work**
