1. CRUD:
    - ~~CRUD~~
    - AJAX - Co się da i ma sens
    - Walidacja:
        - Computer:
            - ~~Stworzyć warunek w walidacji (żeby zlikwidować jeden plik) i zobaczyć jak działa~~
        - ~~Currency~~
        - ~~ComputerTypes~~
        - ~~Dashboard~~
        - ~~Department~~
        - ~~Peripheral~~
        - ~~PeripheralTypes~~
        - ~~Software~~
        - ~~Worker~~
        - Dodać wiadomości do walidacji
        - ~~Przerobić podwójne walidatory pod kątem wartości unique (jeśli jest edycja, to należy zmienić tą wartość w tablicy)~~
1. ~~Poprawić edycję typów komputera, pokazuje błąd o złym id~~
1. Podpięcie API:
    - ~~NBP - Pobieranie danych o walutach~~
        - ~~Podłączenie~~
        - ~~Licznik w dashboard, który pokazuje kiedy waluty były ostatni raz pobierane - zrobione w newapp~~
    - GUS - Pobieranie danych o firmach
    - ~~VIES~~
        - ~~Najpierw podłączyć~~
        - ~~Wystylować~~
        - ~~Kody kraju na select~~
        - ~~Przerobić wyświetlanie kodów na pętle~~
1. ~~Wystawienie własnego RESTApi~~
    - ~~Wykorzystać resource~~
    - ~~Dodać route w layout~~
1. Autoryzacja - podział na administartorów i użytkowników:
    - Po podziale stworzyć panel admina
1. Wykorzystać shared messages w innych view (przykład użycia w Currency)
1. Generowanie PDF
    - Np. lista walut
1. ~~Observer:~~
    - ~~Przy aktualizacji walut~~
    - ~~Wysyłka mail~~
    - ~~Użycie kolejek~~
1. Unit Testy
1. Kalkulatory - może AJAX:
    - Spalania - może coś bardziej rozbudowanego, z zapisem do bazy itd.
    - Przelicznik walut, który bazuje na currency itp.
1. Maski do inputów
1. Readme - Pamiętać o komendzie do pobierania walut:
    1. PL [READMEPL.md](./READMEPL.md)
    1. ENG [READMEENG.md](./READMEENG.md)
1. PHP-DOM
1. Automatyczne tłumaczenia - nie jestem pewien co do tego
1. Cron - zautomatyzować jakąś czynność - jest już dodane w harmonogramie pobieranie walut
1. ~~Uporządkować pliki - kontrolery, modele itd.~~
1. Posegregować widoki
1. ~~Wrzucić na hosting~~
1. Implementacja bootstrap icons
1. Ajaxowy notatnik 

---

## Deploy na hostinghouse
Deploy na vxm według: [Instrukcja](https://www.cloudways.com/blog/stay-away-from-laravel-shared-hosting/?fbclid=IwAR3H5hvJTxUNE6ytYYH0x71n4WHnqnYrhRpBBn5E3k5jLcw2Z9QGRS81-kc)

1. Przenieść Laravela wrzucić do public_html\LaravelApp oprocz pliku `mix_manifest.json`
1. index.php - zamienić linie w ten sposób
    ```php
    // Pierwsza
    if (file_exists(__DIR__.'/storage/framework/maintenance.php')) {
        require __DIR__.'/storage/framework/maintenance.php';
    }

    // Druga
    require __DIR__.'/LaravelApp/vendor/autoload.php';

    // Trzecia
    $app = require_once __DIR__.'/LaravelApp/bootstrap/app.php';
    ```
1. Potem należy za pomocą kodu dokonać migracji.
1. Do używania komend z poziomu kodu używa się fasady Artisan::call('komenda', ['--force' => true]) (np. php artisan migrate = Artisan::call('migrate', ['--force' => true]))
1. Pamiętać o tym, żeby przenieść plik .env!
1. Przy normalnym deploy pamiętać o komendach do cache
