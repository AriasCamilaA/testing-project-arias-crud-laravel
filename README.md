# Taller Testing 3
Crud de tareas creada en laravel, con 10 testeos


### Prerrequisitos
    Tener php agregado a las variables de entorno
    Tener instalado composer

### Pasos para ejecutar test y servidor
1. **Descargar las dependencias:**
   ```bash
    composer update --no-scripts
   ```
   ```bash
    composer install
   ```

2. **Archivos de configuración:**
   ```bash
    copy .env.example .env
   ```

3. **Generar clave:**
   ```bash
    php artisan key:generate
   ```

4. **Ejecutar migración:**
   ```bash
    php artisan migrate
   ```

5. **Ejecutar tests:**
   ```bash
    php artisan test
   ```

6. **Encender el servidor:**
   ```bash
    php artisan serve
   ```