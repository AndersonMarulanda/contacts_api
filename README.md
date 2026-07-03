# Contacts API

API REST desarrollada con **Laravel 13** para la gestión de contactos de usuarios. La aplicación implementa autenticación con Laravel Sanctum, CRUD de contactos, validaciones, paginación, factories, seeders y pruebas automatizadas con Pest.

---

# Tecnologías utilizadas

- PHP 8.2+
- Laravel 13
- Laravel Sanctum
- MySQL
- Composer
- Pest

---

# Requisitos

- PHP 8.2 o superior
- Composer
- MySQL
- Git

---

# Instalación

## 1. Clonar el repositorio

```bash
git clone https://github.com/AndersonMarulanda/contacts_api.git
```

## 2. Entrar al proyecto

```bash
cd contacts_api
```

## 3. Instalar dependencias

```bash
composer install
```

## 4. Copiar el archivo de entorno

```bash
cp .env.example .env
```

## 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

## 6. Configurar la base de datos

Editar el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contacts_api
DB_USERNAME=root
DB_PASSWORD=
```

## 7. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Este comando crea:

- 10 usuarios
- 50 contactos (5 por usuario)

## 8. Ejecutar la aplicación

```bash
php artisan serve
```

La API estará disponible en:

```
http://127.0.0.1:8000
```

---

# Autenticación

La API utiliza **Laravel Sanctum**.

Después de registrarse o iniciar sesión se devuelve un token.

Para acceder a las rutas protegidas enviar el encabezado:

```
Authorization: Bearer TU_TOKEN
```

---

# Endpoints

## Autenticación

### Registrar usuario

**POST** `/api/register`

Body

```json
{
    "name": "Anderson Marulanda",
    "email": "anderson@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

Respuesta

```json
{
    "message": "Usuario registrado correctamente",
    "user": {},
    "token": "..."
}
```

---

### Iniciar sesión

**POST** `/api/login`

Body

```json
{
    "email": "anderson@example.com",
    "password": "password123"
}
```

Respuesta

```json
{
    "message": "Inicio de sesión exitoso.",
    "user": {},
    "token": "..."
}
```

---

### Cerrar sesión

**POST** `/api/logout`

Requiere autenticación.

---

### Actualizar usuario

**PUT** `/api/user`

Requiere autenticación.

Body

```json
{
    "name": "Nuevo Nombre",
    "email": "nuevo@email.com"
}
```

---

# Contactos

Todas las rutas requieren autenticación.

---

### Listar contactos

**GET** `/api/contacts`

Obtiene únicamente los contactos del usuario autenticado.

La respuesta está paginada (5 registros por página).

Ejemplo:

```
GET /api/contacts?page=2
```

---

### Crear contacto

**POST** `/api/contacts`

```json
{
    "nombre": "Juan Pérez",
    "telefono": "3001234567",
    "email": "juan@example.com"
}
```

---

### Ver contacto

**GET** `/api/contacts/{id}`

Ejemplo

```
GET /api/contacts/1
```

---

### Actualizar contacto

**PUT** `/api/contacts/{id}`

```json
{
    "nombre": "Juan Actualizado",
    "telefono": "3019876543"
}
```

---

### Eliminar contacto

**DELETE** `/api/contacts/{id}`

Ejemplo

```
DELETE /api/contacts/1
```

---

# Validaciones

## Usuarios

- Nombre obligatorio.
- Correo electrónico obligatorio.
- El correo debe ser único.
- Contraseña mínima de 8 caracteres.
- Confirmación de contraseña.

## Contactos

- Nombre obligatorio.
- Teléfono obligatorio.
- El teléfono debe ser único.
- Correo electrónico opcional.
- Si se envía, debe ser válido y único.

---

# Seeders

Para generar datos de prueba:

```bash
php artisan migrate:fresh --seed
```

Se crearán automáticamente:

- 10 usuarios.
- 5 contactos por usuario.
- 50 contactos en total.

---

# Pruebas

Ejecutar todas las pruebas:

```bash
php artisan test
```

El proyecto incluye pruebas para:

- Registro de usuario.
- Actualización de usuario.
- Validación de correo duplicado.
- Creación de contactos.
- Listado de contactos.
- Validación de teléfono duplicado.
- Acceso restringido a contactos de otros usuarios.
- Paginación de contactos.

---

# Estructura del proyecto

```
app/
database/
routes/
tests/
```

---

# Autor

**Anderson Marulanda**

GitHub:

https://github.com/AndersonMarulanda/contacts_api

Muchas gracias por leer este documento.