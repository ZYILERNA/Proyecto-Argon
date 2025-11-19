# 🍎 La Huerta Fresca

> Sistema de e-commerce de frutas y verduras frescas desarrollado en PHP puro con almacenamiento en archivos de texto.

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-7952B3?style=flat&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

---

## 📋 Descripción

**La Huerta Fresca** es una aplicación web de comercio electrónico especializada en la venta de productos frescos del campo. Desarrollada completamente en PHP vanilla sin frameworks ni bases de datos, utiliza un sistema de archivos `.txt` para el almacenamiento de datos.

### ✨ Características Principales

- 🔐 **Sistema de autenticación** con sesiones y cookies personalizadas
- 🛒 **Carrito de compras personalizado** por usuario
- 📦 **Gestión de productos** (CRUD completo)
- 🎨 **Interfaz moderna** con Bootstrap 5 y diseño responsivo
- 🕒 **Historial de productos vistos** recientemente
- 🎨 **Temas personalizados** por usuario con cookies temporales
- 📊 **Agrupación inteligente** de productos en el carrito

---

## 🚀 Demo

```
Usuario: usuario1
Contraseña: Pass2024secure
```

[Ver más usuarios disponibles](#-usuarios-de-prueba)

---

## 📸 Screenshots

### Página Principal
![Home](/imagenes/image.png)

### Catálogo de Productos
![Productos](/imagenes/productos.png)

### Carrito de Compras
![Carrito](/imagenes/carrito.png)

---

## 🛠️ Tecnologías Utilizadas

| Tecnología | Versión | Uso |
|------------|---------|-----|
| **PHP** | 7.4+ | Backend y lógica de negocio |
| **Bootstrap** | 5.3.2 | Framework CSS |
| **Bootstrap Icons** | 1.11.1 | Iconografía |
| **HTML5** | - | Estructura |
| **CSS3** | - | Estilos personalizados |
| **JavaScript** | Vanilla | Interactividad |

---

## 📁 Estructura del Proyecto

```
la-huerta-fresca/
│
├── componentes/           # Páginas principales
│   ├── index.php         # Página de inicio
│   ├── login.php         # Página de login
│   ├── productos.php     # Catálogo de productos
│   ├── carrito.php       # Carrito de compras
│   ├── reciente.php      # Productos vistos recientemente
│   └── formulario.php    # Formulario crear producto
│
├── procedimientos/        # Lógica de procesamiento
│   ├── login.proc.php    # Autenticación
│   ├── logout.proc.php   # Cierre de sesión
│   ├── carrito.proc.php  # Añadir al carrito
│   └── crear_producto.proc.php
│
├── funciones/             # Funciones auxiliares
│   └── eliminar.php      # Eliminar del carrito
│
├── include/               # Componentes reutilizables
│   ├── hlogin.html       # Header sin sesión
│   ├── hlogout.html      # Header con sesión
│   ├── footer.html       # Footer
│   └── color_fondo.php   # Sistema de temas
│
├── productos/             # Almacenamiento de datos
│   ├── productos.txt     # Lista de productos
│   ├── sresu.txt         # Usuarios (hash MD5)
│   ├── carrito_*.txt     # Carritos por usuario
│   └── reciente_*.txt    # Historial por usuario
│
└── imagenes/              # Recursos gráficos
    ├── manzana.jpg
    ├── platano.jpg
    └── ...
```

---

## ⚙️ Instalación

### Requisitos Previos

- PHP 7.4 o superior
- Servidor web (Apache/Nginx)
- XAMPP, WAMP, MAMP o similar (para desarrollo local)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/la-huerta-fresca.git
   cd la-huerta-fresca
   ```

2. **Configurar el servidor**
   - Copiar la carpeta al directorio `htdocs` (XAMPP) o `www` (WAMP)
   - O usar el servidor integrado de PHP:
   ```bash
   php -S localhost:8000 -t componentes/
   ```

3. **Configurar permisos** (Linux/Mac)
   ```bash
   chmod 755 componentes/ procedimientos/ funciones/
   chmod 777 productos/
   chmod 644 productos/*.txt
   ```

4. **Acceder a la aplicación**
   ```
   http://localhost/la-huerta-fresca/componentes/index.php
   # O si usas el servidor integrado:
   http://localhost:8000/index.php
   ```

---

## 👥 Usuarios de Prueba

| Usuario | Contraseña | Color de Tema |
|---------|-----------|---------------|
| `usuario1` | `Pass2024secure` | Rosa claro |
| `usuario2` | `Marte789Quick` | Azul claro |
| `usuario3` | `Ocean456Blue` | Verde claro |
| `usuario4` | `Tiger2024Strong` | Naranja claro |
| `usuario5` | `Phoenix321Fire` | Púrpura claro |
| `usuario6` | `Dragon654Power` | Amarillo claro |

---

## 🎯 Funcionalidades Detalladas

### 1. Sistema de Autenticación
- Login con usuario y contraseña (hash MD5)
- Gestión de sesiones PHP
- Cookies personalizadas con expiración de 30 segundos
- Tema de color único por usuario

### 2. Gestión de Productos
- **Ver catálogo** con diseño tipo tarjetas
- **Crear nuevos productos** mediante formulario
- **Añadir al carrito** con un clic
- **Stock disponible** mostrado en tiempo real

### 3. Carrito de Compras
- **Carrito personalizado** por usuario (archivo independiente)
- **Agrupación automática** de productos repetidos
- **Contador de cantidad** por producto
- **Eliminación selectiva** de productos
- **Cálculo de total** en tiempo real
- **Resumen del pedido** con detalles

### 4. Historial de Vistos
- Registro automático de productos consultados
- Vista sin duplicados
- Almacenamiento por usuario

### 5. Diseño Responsivo
- Adaptable a móviles, tablets y escritorio
- Animaciones suaves (hover effects)
- Gradientes modernos
- Iconografía intuitiva

---

## 🔒 Seguridad

### Implementaciones de Seguridad

- ✅ Contraseñas hasheadas con MD5 (⚠️ **Nota:** En producción usar `password_hash()`)
- ✅ Validación de sesiones activas
- ✅ Sanitización con `htmlspecialchars()`
- ✅ Protección contra inyección de rutas
- ✅ Validación de entrada de formularios

### ⚠️ Recomendaciones para Producción

```php
// Cambiar de MD5 a:
$hash = password_hash($password, PASSWORD_BCRYPT);
$verify = password_verify($password, $hash);

// Añadir protección CSRF
// Usar PDO/MySQLi en lugar de archivos .txt
// Implementar validación del lado del servidor más robusta
```

---

## 📝 Sistema de Archivos

### Formato de Datos

**productos.txt**
```
Nombre|Precio|Stock|Descripción|Imagen
```

**Ejemplo:**
```
Manzana|1.50|10|Manzanas rojas de la casa de juan|../imagenes/manzana.jpg
Platano|0.75|20|Platanos amarillos de la casa de pepe|../imagenes/platano.jpg
```

**sresu.txt** (Usuarios)
```
usuario|hash_md5_password
```

**carrito_usuario1.txt** (Carrito personal)
```
Nombre|Precio|Stock|Descripción|Imagen
```

---

## 🎨 Personalización

### Cambiar Colores del Tema

Editar en `procedimientos/login.proc.php`:

```php
$colores_usuarios = [
    'usuario1' => '#TU_COLOR_AQUI',
    // ...
];
```

### Cambiar Duración de Cookies

```php
// En login.proc.php
setcookie('color_fondo', $color_usuario, time() + 86400, '/'); // 24 horas
```

### Agregar Nuevos Usuarios

1. Generar hash MD5:
```php
echo md5('tu_contraseña');
```

2. Añadir al archivo `productos/sresu.txt`:
```
nuevo_usuario|hash_md5_generado
```

---

## 🔮 Posibles Mejoras Futuras

- [ ] **Migración a base de datos** (MySQL/PostgreSQL)
- [ ] **Sistema de registro** de nuevos usuarios
- [ ] **Panel de administración avanzado**
- [ ] **Buscador de productos** con filtros

---

## 🐛 Problemas Conocidos

| Problema | Solución Temporal |
|----------|-------------------|
| Cookies expiran muy rápido (30s) | Aumentar tiempo en `login.proc.php` |
| MD5 no es seguro | Usar `password_hash()` en producción |
| Sin validación de stock | Implementar verificación antes de añadir |
| Archivos .txt no escalables | Migrar a base de datos |

---