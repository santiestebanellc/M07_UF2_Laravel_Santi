# **Analysis**

## **1. Routes**
- **1.1.** What are they and their purpose?  
Las rutas en Laravel definen los puntos de entrada de la aplicación, permitiendo gestionar las
solicitudes HTTP y asignarlas a controladores o funciones específicas.

- **1.2.** Where are they defined? 
Se encuentran en el directorio `routes/`, específicamente en los archivos:
- `web.php`: Para rutas accesibles desde el navegador.
- `api.php`: Para rutas de API.
- `console.php`: Para comandos Artisan.
- `channels.php`: Para eventos de broadcasting. 

- **1.3.** How many are there?  
Hay cuatro archivos de rutas (`web.php`, `api.php`, `console.php` y `channels.php`), pero el
número exacto de rutas dependerá del contenido de estos archivos.

- **1.4.** How do they group?  
Se agrupan en:
- Rutas web (`web.php`).
- Rutas API (`api.php`).
- Rutas de consola (`console.php`).
- Rutas de broadcasting (`channels.php`).

- **1.5.** Which prefix do they use?  
- Las rutas en `web.php` generalmente no tienen prefijo.
- Las rutas en `api.php` suelen usar el prefijo `api/`.
- Las rutas en `channels.php` dependen de eventos de broadcasting.
- Las rutas en `console.php` no tienen prefijo, ya que son comandos de consola.

- **1.6.** Which parameters do they use?  
Dependerá de la implementación en los archivos de rutas, pero generalmente se usan parámetros
como IDs (`{id}`) o nombres (`{name}`) en las URLs dinámicas.

## **2. Middleware**
- **2.1.** What are they and their purpose?  
Son filtros que se ejecutan antes o después de una solicitud HTTP para aplicar reglas como
autenticación, validación o seguridad.

- **2.2.** Where are they defined? 
En `app/Http/Middleware/`. Se registran en `app/Http/Kernel.php`.

- **2.3.** How many are there?  
Existen varios middlewares, incluyendo autenticación, protección CSRF y validación de año
(`ValidateYear.php`).

- **2.4.** Which parameters do they use?  
Algunos pueden recibir parámetros, como `auth` para restringir acceso o `throttle` para limitar el número de solicitudes.

- **2.5.** When are they invoked?  
Se invocan automáticamente cuando una ruta lo requiere, según su definición en `Kernel.php` o
cuando se asignan manualmente a rutas específicas.

## **3. Data**
- **3.1.** Where are they defined?  
Los datos de películas están en `storage/app/public/films.json` en formato JSON.

- **3.2.** How are they read?  
Se leen con `Storage::json('/public/films.json')` en `FilmController.php`.

## **4. Controller**
- **4.1.** What are they and their purpose?  
Son clases que gestionan la lógica de la aplicación al recibir peticiones HTTP.

- **4.2.** Where are they defined?  
En `app/Http/Controllers/`.

- **4.3.** How many are there?  
Al menos `FilmController.php`, que maneja la gestión de películas.

## **5. View**
- **5.1.** What are they and their purpose?  
Son plantillas Blade (`.blade.php`) que renderizan el HTML dinámicamente.

- **5.2.** Where are they defined?  
En `resources/views/`, incluyendo `films/list.blade.php` y `welcome.blade.php`.

- **5.3.** How many are there?  
Popr lo menos dos (`films/list.blade.php` y `welcome.blade.php`), pero podrían existir
más.

---

## **Implementation Enhancements Opened as Issues**
For more details, check out the [issues here](https://github.com/Stucom-Pelai/M07_UF2_Laravel/issues).


