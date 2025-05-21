# Proyecto de Gestión de Recursos Humanos y Nóminas

Este repositorio contiene un sistema de administración desarrollado sobre **Laravel** que incluye gestión de usuarios, colaboradores, nóminas, prestaciones e indicadores de productividad, así como generación de reportes interactivos con **DataTables** y exportación a Excel.

> **Plantilla base**: Materio Free Bootstrap 5 HTML Laravel Admin Template

---

## Tecnologías y dependencias

* **Backend**: Laravel (PHP 8+)
* **Frontend**: Bootstrap 5, jQuery
* **Tablas interactivas**: DataTables + Buttons + JSZip (exportar a Excel, CSV, PDF)
* **Base de datos**: SQL Server (con Eloquent)

---

## Instalación rápida

1. Clona este repositorio:

   ```bash
   git clone <url-del-repo>
   cd <directorio>
   ```
2. Instala dependencias PHP:

   ```bash
   composer install
   php artisan key:generate
   ```
3. Instala dependencias de Node/Yarn y compila assets:

   ```bash
   yarn install
   yarn dev
   ```
4. Configura tu `.env` con la conexión a SQL Server.
5. Ejecuta migraciones y seeders si existen:

   ```bash
   php artisan migrate
   ```
6. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

---

## Módulos principales

* **Usuarios**: registro, asignación de roles.
* **Colaboradores**: alta, edición (modales), baja lógica (activo/inactivo).
* **Nóminas**: alta/edición de nómina (mensual, quincenal, semanal).
* **Prestaciones**: bono, comisión y otros.
* **Productividad**: indicadores con calificación en estrellas.
* **Reportes**: panel de reportes con cards y DataTables para:

  * Resumen mensual de nóminas.
  * Nóminas por colaborador y año.
  * Totales de prestaciones por tipo.
  * Promedios de indicadores por categoría.

---

## Estructura de rutas

```php
Route::prefix('administracion')
     ->name('administracion.')
     ->group(function(){
         Route::get('usuarios', ...);
         Route::resource('empleados', ...)->except(['show']);
         Route::resource('nominas',     ...);
         Route::resource('prestaciones',...);
         Route::resource('productividad',...);
         Route::get('reportes',                ...)->name('reportes.index');
         Route::get('reportes/nominas',        ...)->name('reportes.nominas');
         Route::get('reportes/prestaciones',   ...)->name('reportes.prestaciones');
         Route::get('reportes/productividad',  ...)->name('reportes.productividad');
});
```

---

## Personalización y estilo

* Los listados y modales siguen el diseño de Materio.
* DataTables se configura con idioma en español y exportación integradas.
* Las vistas usan componentes de Bootstrap 5 y Material Design Icons (mdi).

---



