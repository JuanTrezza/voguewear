# Despliegue con Docker (local y en la nube)

Este proyecto usa PHP + MySQL (MariaDB). GitHub Pages no ejecuta PHP. Para que la página funcione en un servidor público es recomendable desplegarla en un host que ejecute PHP o usar contenedores Docker.

Instrucciones rápidas (local):

1. Copiar `.env.template` a `.env` y, si quieres, ajustar las contraseñas:

```powershell
copy .env.template .env
```

2. Levantar con `docker-compose` (mapeará el sitio en `http://localhost:8080`):

```powershell
docker-compose up -d --build
```

3. Importar la base de datos MySQL (crea la base y tablas). Si tienes un SQL dump, por ejemplo `dump.sql`:

```powershell
docker exec -i $(docker-compose ps -q db) sh -c 'mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE' < dump.sql
```

4. Abrir en el navegador: `http://localhost:8080/`

Despliegue en la nube:
- Subir el repositorio a un proveedor que acepte imágenes Docker (por ejemplo: Render, Railway, Fly.io, DigitalOcean App Platform, un VPS).
- Configurar variables de entorno equivalentes (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).
- Provisionar una base de datos gestionada (MySQL/MariaDB) o usar un servicio separado de base de datos.

Notas:
- Si prefieres sólo publicar una versión visible estática (sin PHP), puedo generar un snapshot estático y activarlo en GitHub Pages.
