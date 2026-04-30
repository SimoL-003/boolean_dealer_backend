# Boolean Dealer

> **Piattaforma full-stack per la gestione di una concessionaria di auto usate**  
> Progetto scolastico sviluppato durante il corso di Boolean

---

## Panoramica del progetto

**Boolean Dealer** è una piattaforma web full-stack pensata per la gestione interna di una concessionaria di auto usate. Il sistema è diviso in due parti distinte:

- **Backoffice** (Laravel + Blade): pannello amministrativo protetto da autenticazione, utilizzato dal personale della concessionaria per gestire il catalogo veicoli e le configurazioni di sistema.
- **Frontend** (React): interfaccia pubblica che consente ai visitatori di sfogliare i veicoli disponibili, visualizzare le schede dettaglio e filtrare l'offerta.

Le due applicazioni comunicano tramite **API REST** esposte da Laravel e consumate da React.

---

## Stack tecnologico

### Backend

| Tecnologia          | Ruolo                                           |
| ------------------- | ----------------------------------------------- |
| **Laravel** (PHP)   | Framework MVC per backoffice e API REST         |
| **Laravel Breeze**  | Autenticazione (login, registrazione, sessioni) |
| **Blade**           | Template engine per il backoffice               |
| **Eloquent ORM**    | Gestione del database con relazioni             |
| **Laravel Storage** | Upload e gestione immagini (`disk('public')`)   |
| **MySQL**           | Database relazionale                            |

### Frontend

| Tecnologia        | Ruolo                          |
| ----------------- | ------------------------------ |
| **React**         | Interfaccia pubblica utente    |
| **Axios / Fetch** | Chiamate HTTP alle API Laravel |

### Styling

| Tecnologia                | Ruolo                             |
| ------------------------- | --------------------------------- |
| **SCSS**                  | Stili con variabili e nesting     |
| **CSS Custom Properties** | Tema colore coerente              |
| **Bootstrap**             | Stile della dashboard del backend |
| **Tailwind**              | Stile del frontend                |

---

## Architettura del progetto

```
┌─────────────────────────────────────────────────────┐
│                    BROWSER                          │
│                                                     │
│   ┌──────────────────┐    ┌──────────────────────┐  │
│   │  React Frontend  │    │  Laravel Backoffice  │  │
│   │  (pubblico)      │    │  (protetto da auth)  │  │
│   └────────┬─────────┘    └──────────┬───────────┘  │
└────────────│─────────────────────────│──────────────┘
             │ API REST (JSON)         │ Blade Views
             ▼                         ▼
┌─────────────────────────────────────────────────────┐
│                  Laravel Server                     │
│                                                     │
│   ┌──────────────┐       ┌──────────────────────┐   │
│   │ API Routes   │       │   Web Routes         │   │
│   │ (Sanctum)    │       │   (auth middleware)  │   │
│   └──────┬───────┘       └──────────┬───────────┘   │
│          │                          │               │
│          ▼                          ▼               │
│   ┌──────────────────────────────────────────────┐  │
│   │           Controllers / Eloquent             │  │
│   └──────────────────────┬───────────────────────┘  │
│                          │                          │
│                          ▼                          │
│   ┌──────────────────────────────────────────────┐  │
│   │              MySQL Database                  │  │
│   └──────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────┘
```

---

## 🗄 Schema del database

### Tabelle principali

```
brands              car_models             fuel_types
──────────          ──────────────         ──────────
id (PK)             id (PK)                id (PK)
name                name                   name
country             brand_id (FK)
created_at          created_at
updated_at          updated_at


optionals           cars                   car_option (pivot)
──────────          ────────────────────   ──────────────────
id (PK)             id (PK)                car_id (FK)
name                brand_id (FK)          option_id (FK)
created_at          car_model_id (FK)
updated_at          fuel_type_id (FK)
                    plate (unique, null)
                    chassis (unique, null)
                    year
                    km
                    price
                    color
                    description
                    image
                    is_available
                    created_at
                    updated_at
```

### Relazioni Eloquent

- `Brand` → hasMany → `CarModel`
- `CarModel` → belongsTo → `Brand`
- `Car` → belongsTo → `Brand`, `CarModel`, `FuelType`
- `Car` → belongsToMany → `Optional` (tramite `car_option`)
- `Optional` → belongsToMany → `Car`

---

## Funzionalità implementate

### Gestione veicoli

- Elenco di tutti i veicoli con filtri e anteprima immagine
- Scheda dettaglio veicolo con tutte le specifiche e optionals
- Creazione nuovo veicolo con upload immagine
- Modifica veicolo esistente (con pre-popolamento form, inclusi optionals)
- Eliminazione veicolo (con verifica relazioni pre-delete)
- Campi `plate` e `chassis` nullable ma con vincolo unique (ignora i `NULL`)

### Gestione configurazioni (Settings)

- CRUD completo per **Brand** (marchi), con country associato
- CRUD completo per **CarModel** (modelli), filtrati per brand
- CRUD completo per **FuelType** (tipi di carburante)
- CRUD completo per **Optional** (accessori/dotazioni)
- Dashboard settings divisa in 4 card indipendenti

### Autenticazione (backoffice)

- Login / Logout con Laravel Breeze
- Protezione di tutte le route del backoffice con middleware `auth`
- Sessioni gestite server-side

### API per il frontend React

- Endpoint `/api/cars` – lista veicoli (JSON)
- Endpoint `/api/cars/{id}` – dettaglio veicolo (JSON)
- Middleware `auth:sanctum` configurabile per proteggere le API

### UX & Form

- Select dinamica brand/modello: al cambio brand, i modelli si aggiornano via JS (`loadModels()`)
- Checkbox optionals con stile toggle via CSS `:has(input:checked)` (no JS)
- Flash messages per conferma operazioni (creazione, modifica, eliminazione)
- Validazione server-side con messaggi d'errore inline
- Controllo pre-eliminazione: blocco se esistono relazioni dipendenti

---

## Backoffice Laravel

### Struttura MVC

```
app/
├── Http/
│   └── Controllers/
│       ├── CarController.php          # CRUD veicoli + upload immagini
│       ├── BrandController.php        # CRUD marchi
│       ├── CarModelController.php     # CRUD modelli
│       ├── FuelTypeController.php     # CRUD tipi carburante
│       └── OptionalController.php    # CRUD optionals
├── Models/
│   ├── Car.php
│   ├── Brand.php
│   ├── CarModel.php
│   ├── FuelType.php
│   └── Optional.php
```

### Route principali

```php
// Backoffice (protette da auth)
Route::middleware('auth')->group(function () {
    Route::resource('our-cars', CarController::class)
         ->parameters(['our-cars' => 'car']);

    Route::resource('brands', BrandController::class);
    Route::resource('car-models', CarModelController::class);
    Route::resource('fuel-types', FuelTypeController::class);
    Route::resource('optionals', OptionalController::class);
});

// API per React
Route::prefix('api')->group(function () {
    Route::get('/cars', [CarController::class, 'apiIndex']);
    Route::get('/cars/{car}', [CarController::class, 'apiShow']);
});
```

> **Nota**: Il parametro `our-cars` è mappato esplicitamente su `car` tramite `->parameters([...])` per il corretto funzionamento del Route Model Binding con route con trattino.

### Upload immagini

Le immagini vengono salvate su `storage/app/public/cars/` e rese accessibili tramite symlink (`php artisan storage:link`). Il campo `image` in database contiene solo il path relativo.

```php
// Salvataggio
$path = $request->file('image')->store('cars', 'public');

// Eliminazione al replace
Storage::disk('public')->delete($car->image);
```

### Validazione campi unique nullable

Per i campi `plate` e `chassis` — opzionali ma univoci quando presenti — la validazione usa:

```php
Rule::unique('cars', 'plate')->ignore($car->id)->whereNotNull('plate')
```

In fase di salvataggio, le stringhe vuote vengono convertite in `NULL` per non violare il vincolo unique:

```php
'plate' => $request->plate ?: null,
```

---

## Frontend React

Il frontend consuma le API di Laravel per mostrare il catalogo veicoli al pubblico.

### Funzionalità

- Visualizzazione lista veicoli disponibili
- Scheda dettaglio con immagine, specifiche tecniche e dotazioni
- Collegamento alle API tramite `fetch` / Axios

### Comunicazione con il backend

Le API Laravel non richiedono autenticazione per la lettura pubblica. Il frontend chiama direttamente gli endpoint REST.

---

## 📡 API Endpoints

| Metodo | Endpoint         | Descrizione               | Auth |
| ------ | ---------------- | ------------------------- | ---- |
| `GET`  | `/api/cars`      | Lista tutti i veicoli     | No   |
| `GET`  | `/api/cars/{id}` | Dettaglio singolo veicolo | No   |
