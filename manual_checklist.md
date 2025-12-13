# 📱 Checklist Manual de Experiencia (Protocolo de Vuelo)

Este protocolo debe ser ejecutado desde un dispositivo móvil real o en modo de emulación móvil.

## 1. UX Móvil
- [ ] **Barra de Navegación Inferior**: Verificar que esté visible y fija en la parte inferior.
- [ ] **Interacción**: Tocar cada ícono (Inicio, Buscar, Vender, Perfil) y verificar la navegación fluida.
- [ ] **Espaciado**: Verificar que el contenido no quede oculto detrás de la barra de navegación (padding-bottom correcto).

## 2. PWA (Progressive Web App)
- [ ] **Instalación**: Verificar que aparezca el prompt o botón de "Instalar App" (o "Agregar a Inicio").
- [ ] **Icono**: Al instalar, verificar que el icono de la app se vea correcto en el home del celular.
- [ ] **Splash Screen**: Al abrir la app instalada, verificar que cargue con la pantalla de inicio correcta.

## 3. Navegación y Home
- [ ] **Scroll de Destacados**: Probar el scroll horizontal en la sección de productos destacados. Debe ser suave.
- [ ] **Filtrado por Categoría**: Tocar una categoría (ej. "Tecnología") y verificar que SOLO se muestren productos de esa categoría.
- [ ] **Búsqueda**: Usar la barra de búsqueda para encontrar un producto específico.

## 4. Flujo de Vendedor
- [ ] **Crear Producto**: Ir a "Vender", completar el formulario con título, precio y descripción.
- [ ] **Subida de Foto**: Adjuntar una foto real desde la galería del celular.
- [ ] **Persistencia**: Guardar el producto y verificar que aparezca en "Mis Publicaciones" con la foto correcta.
- [ ] **Link de WhatsApp**: Entrar al detalle del producto creado y probar el botón de "Contactar". Debe abrir WhatsApp con el mensaje predefinido.

## 5. Performance
- [ ] **Carga de Imágenes**: Verificar que las imágenes de los productos carguen rápido (lazy loading).
- [ ] **Transiciones**: Navegar entre páginas y sentir la velocidad de respuesta.

---
**Resultado Final:**
- [ ] APROBADO ✅
- [ ] REQUIERE AJUSTES ⚠️
