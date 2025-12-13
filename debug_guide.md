# 🛠️ Guía de Solución de Errores en Railway

Si ves "Application failed to respond", sigue estos pasos:

## 1. Revisa los Logs de Despliegue
En el dashboard de Railway, haz clic en tu servicio y ve a la pestaña **Deployments**. Haz clic en el último despliegue y mira los logs.
- **¿Dice "MIGRATION FAILED"?** -> Revisa tus variables `DB_CONNECTION`, `DB_URL`, etc.
- **¿Dice "Apache started"?** -> Entonces el contenedor arrancó bien, pero quizás el puerto falló.

## 2. Verifica las Variables de Entorno
Asegúrate de que estas variables estén EXACTAS en Railway:
- `APP_KEY`: Debe tener 32 caracteres (ej. `base64:...`).
- `APP_URL`: `https://<tu-proyecto>.up.railway.app` (sin barra al final).
- `DB_CONNECTION`: `pgsql`
- `DB_URL`: `${DATABASE_URL}`

## 3. El Cambio que Acabo de Hacer
He modificado `docker-entrypoint.sh` para:
1.  **Puerto Dinámico:** Ahora lee la variable `$PORT` de Railway y configura Apache automáticamente. Esto suele ser la causa #1 de "Application failed to respond".
2.  **Logs Claros:** Ahora te dirá exactamente si fallan las migraciones.

## 4. Próximo Paso
Haz un nuevo commit y push. Si falla, **copia y pega los logs aquí**.
