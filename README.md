# Práctica 7 — Web App con Dockerfile y Docker Compose

Aplicación web "Hola Mundo" en **PHP 8.3 + Apache** que se conecta a una base de datos **MySQL 8.4**, todo orquestado con Docker Compose.

## Estructura

```
.
├── Dockerfile          # Imagen de la app: php:8.3-apache + extensión pdo_mysql
├── docker-compose.yml  # Servicios: app (PHP) y db (MySQL)
├── db/
│   └── init.sql        # Crea la tabla `mensajes` con datos de ejemplo
└── src/
    └── index.php       # Hola Mundo que consulta la BD
```

## Servicios

| Servicio | Imagen | Puerto | Descripción |
|----------|--------|--------|-------------|
| `app` | build del `Dockerfile` | 8082 → 80 | Servidor de aplicación PHP/Apache |
| `db`  | `mysql:8.4` | interno 3306 | Base de datos `holamundo` |

La app lee la conexión de variables de entorno (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`) y espera a que MySQL esté listo gracias al `healthcheck` + `depends_on`.

## Uso

```bash
docker compose up -d --build
```

Abrir http://localhost:8082. Debe mostrar "Hola Mundo", la versión de MySQL y los mensajes de la tabla.

Para detenerlo (y borrar los datos con `-v`):

```bash
docker compose down -v
```

> Las credenciales del `docker-compose.yml` son de ejemplo, solo para uso local.

---
Yojairo Rodriguez — Electiva 2, ITLA
