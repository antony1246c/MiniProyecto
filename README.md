# MiniProyecto Grupal

## 📌 Información del Proyecto

**Universidad:** Universidad Tecnológica de Panamá  
**Facultad:** Ingeniería de Sistemas Computacionales  
**Curso:** Desarrollo de Software VII  
**Salón:** 1GS131  
**Fecha de Realización:** Junio 2026

## 👥 Integrantes del Grupo

| Nombre | Cédula |
|--------|--------|
| Solin Rodriguez | 8-1032-104 |
| Ana Cheung | 8-1033-725 |
| Carlos Diaz | 7-713-1842 |

---

## 📖 Introducción

MiniProyecto es una aplicación web desarrollada en PHP que implementa soluciones a 9 problemas matemáticos y algorítmicos. El proyecto sigue el patrón de diseño **Model-View-Controller (MVC)** y aplica principios de **Programación Orientada a Objetos (POO)** con énfasis en código limpio, reutilizable y seguro.

### Objetivos
- Demostrar el uso de estructuras de control: `if`, `switch`, `while`, `for`, `foreach`
- Implementar métodos estáticos y POO
- Aplicar validación y sanitización de datos (OWASP)
- Mantener el código limpio siguiendo PSR-1
- Aplicar el principio DRY (Don't Repeat Yourself)

---

## 🛠️ Tecnologías Utilizadas

| Tecnología | Versión | Descripción |
|------------|---------|-------------|
| **PHP** | 7.4+ | Lenguaje de programación backend |
| **HTML5** | - | Estructura y semántica web |
| **CSS3** | - | Estilos y diseño responsivo |
| **JavaScript** | ES6+ | Interactividad del lado cliente |
| **Chart.js** | 4.4.0 | Librerías para gráficas (pie, bar) |
| **Composer** | - | Gestor de dependencias PHP |
| **Font Awesome** | 6.5.0 | Iconos |
| **Boxicons** | 2.1.4 | Iconos modernos |

---

## 📁 Estructura del Proyecto

```
MiniProyecto/
├── public/
│   ├── index.php                 # Controlador principal
│   ├── script.js                 # JavaScript global
│   └── problems/
│       ├── p1.php - p9.php      # Vistas de problemas
├── src/
│   ├── Utilidades.php            # Funciones de validación y sanitización
│   ├── Components/
│   │   ├── header.php            # Encabezado reutilizable
│   │   └── footer.php            # Pie de página reutilizable
│   ├── Problems/                 # Lógica de negocio (Model)
│   │   ├── Edades.php
│   │   ├── Multiplos.php
│   │   ├── Presupuesto.php
│   │   ├── Estadisticos.php
│   │   ├── Potencias.php
│   │   ├── EstacionAnio.php
│   │   └── SumaNumeros.php
│   └── estilos/                  # Hojas de estilo
│       └── estiloP*.css
├── vendor/                       # Autoload de Composer
└── composer.json                 # Configuración de dependencias
```

---

## 🎯 Problemas Implementados

### Problema 1: Estadísticos (Media, Desviación Estándar, Mín, Máx)
- Calcula estadísticas de 5 números
- Clase: `Estadisticos`
- Método: `calcularEstadisticas(array $numeros)`

### Problema 2: Suma del 1 al 1000
- Suma de números consecutivos usando fórmula
- Clase: `SumaNumeros`
- Método: `calcular(int $primero, int $ultimo, int $n)`

### Problema 3: Múltiplos de 4
- Calcula múltiplos de 4 hasta N
- Clase: `Multiplos`
- Método: `calcular(int $cantidad)`

### Problema 4: Pares e Impares
- Clasifica y suma números pares e impares
- Lógica iterativa con `for` y `foreach`

### Problema 5: Clasificación de Edades ⭐
- Clasifica edades en categorías (Niños, Adolescentes, Adultos, Adulto Mayor)
- **Usa `switch(true)` por rango de edad**
- Gráfica de pastel (Pie chart con Chart.js)
- Muestra edades repetidas

### Problema 6: Presupuesto Hospitalario
- Distribuye presupuesto entre departamentos (40%, 35%, 25%)
- Clase: `Presupuesto`
- Gráfica de barras

### Problema 7: Estadísticos Avanzados
- Calcula media, desviación estándar, mín, máx de N valores

### Problema 8: Estación del Año ⭐
- Determina la estación según la fecha
- **Usa `switch($mes)` con casos múltiples**
- Operadores ternarios para transiciones de días

### Problema 9: Potencias
- Calcula potencias de un número hasta el límite
- Clase: `Potencias`
- Método: `calcular(int $base, int $limite)`

---

## 🔐 Seguridad y OWASP

### A03:2021 - Injection (Prevención de XSS)

#### Implementación: `Utilidades::sanitizar()`
```php
public static function sanitizar(string $valor): string
{
    return htmlspecialchars(strip_tags(trim($valor)));
}
```

**Aplicación en el proyecto:**
- Se usa en todos los formularios antes de reimprimir datos del usuario
- `htmlspecialchars()` convierte caracteres especiales a entidades HTML
- `strip_tags()` elimina etiquetas HTML/PHP maliciosas
- Ejemplo en p5.php: `Utilidades::sanitizar($_POST['numeros'][$i])`

### A03:2021 - Input Validation

#### Implementación: `Utilidades::validarNumeroPositivo()`
```php
public static function validarNumeroPositivo(string $valor): ?float
{
    $limpio = self::sanitizar($valor);
    if (filter_var($limpio, FILTER_VALIDATE_FLOAT) === false) {
        return null;
    }
    $num = (float) $limpio;
    return $num >= 0 ? $num : null;
}
```

**Aplicación en el proyecto:**
- Valida que los valores sean números positivos antes de procesarlos
- Usa `filter_var()` con `FILTER_VALIDATE_FLOAT` (OWASP recomendado)
- Valida rango: números >= 0
- Si la validación falla, retorna `null` y muestra error

#### Ejemplo en p5.php:
```php
$numeros = Utilidades::validarNumerosPositivos($raw);
if ($numeros === null || count($numeros) !== 5) {
    $error = 'Ingresa exactamente 5 edades válidas.';
}
```

### Error Handling Seguro

#### Implementación: Validación de parámetros
```php
// En index.php
switch ($problema) {
    case 1:
    case 2:
    // ... casos 3-9
        include __DIR__ . "/problems/p{$problema}.php";
        break;
    default:
        echo '<div class="text">Problema no encontrado.</div>';
}
```

**Aplicación en el proyecto:**
- Valida `?p` es integer entre 1-9
- Si es inválido, muestra mensaje genérico sin exponer rutas
- Evita acceso a archivos no autorizados

---

## 🧮 Funciones Matemáticas

### Estadísticos (Clase: `Estadisticos`)
```php
public static function calcularEstadisticos(array $numeros): array
{
    $media = array_sum($numeros) / count($numeros);
    $varianza = array_sum(
        array_map(fn($x) => pow($x - $media, 2), $numeros)
    ) / count($numeros);
    
    return [
        'media'     => number_format($media, 2),
        'desv_std'  => number_format(sqrt($varianza), 2),
        'min'       => min($numeros),
        'max'       => max($numeros)
    ];
}
```

**Fórmulas aplicadas:**
- Media: `Σx / n`
- Varianza: `Σ(x - media)² / n`
- Desviación estándar: `√varianza`

### Suma de Números Consecutivos (Clase: `SumaNumeros`)
```php
public static function calcular(int $primero, int $ultimo, int $n): int
{
    // Fórmula: n(primero + último) / 2
    return ($n * ($primero + $ultimo)) / 2;
}
```

### Múltiplos (Clase: `Multiplos`)
```php
public static function calcular(int $cantidad): array
{
    $resultado = [];
    for ($i = 1; $i <= $cantidad; $i++) {
        $resultado[] = 4 * $i;
    }
    return $resultado;
}
```

### Potencias (Clase: `Potencias`)
```php
public static function calcular(int $base, int $limite = 15): array
{
    $resultado = [];
    for ($i = 1; $i <= $limite; $i++) {
        $resultado[] = [
            'exponente' => $i,
            'valor'     => pow($base, $i)
        ];
    }
    return $resultado;
}
```

### Presupuesto (Clase: `Presupuesto`)
```php
public static function calcularPresupuesto(int $cantidad): array
{
    return [
        'Ginecologia 40%'   => $cantidad * 0.40,
        'Traumatologia 35%' => $cantidad * 0.35,
        'Pediatria 25%'     => $cantidad * 0.25
    ];
}
```

---

## ✅ Validación y Sanitización

### Clase: `Utilidades`

#### Método 1: `sanitizar(string $valor): string`
```php
// Aplica:
// - trim(): Elimina espacios en blanco
// - strip_tags(): Elimina etiquetas HTML
// - htmlspecialchars(): Convierte caracteres especiales
return htmlspecialchars(strip_tags(trim($valor)));
```

#### Método 2: `validarNumeroPositivo(string $valor): ?float`
```php
// Validaciones:
// - Sanitiza primero
// - Valida con filter_var(FILTER_VALIDATE_FLOAT)
// - Verifica que sea >= 0
// - Retorna null si falla
```

#### Método 3: `validarNumerosPositivos(array $valores): ?array`
```php
// Valida un array de números
// Retorna null si alguno falla
```

### Uso en Formularios
```php
// En los problemas:
if ($numeros === null || count($numeros) !== 5) {
    $error = 'Ingresa exactamente 5 edades válidas.';
}
```

---

## 📊 Características Principales

### ✨ Principios Aplicados

| Principio | Implementación |
|-----------|-----------------|
| **MVC** | Model (Problems/), View (problems/*.php), Controller (index.php) |
| **POO** | Clases con métodos estáticos en `src/Problems/` |
| **PSR-1** | Namespaces, camelCase, StudlyCaps para clases |
| **DRY** | Componentes reutilizables (header, footer, Utilidades) |
| **OWASP** | Sanitización, validación, error handling seguro |

### 🎨 Características Visuales

- Diseño responsivo con CSS Grid
- Modo Light/Dark automático con localStorage
- Gráficas interactivas con Chart.js
- Sidebar colapsable
- Animaciones suaves
- Footer dinámico con fecha actual

### 🔄 Estructuras de Control

- ✅ `if` / `elseif` / `else`
- ✅ `switch` / `case` (EstacionAnio, Edades)
- ✅ `for` (iteraciones)
- ✅ `foreach` (arrays)
- ✅ `while` (condicionales)
- ✅ Operadores ternarios

---

## 🚀 Instalación y Uso

### Requisitos
- PHP 7.4+
- Servidor web (Apache, Nginx)
- Composer

### Pasos
1. Clonar/descargar el repositorio
2. Navegar a la carpeta: `cd MiniProyecto`
3. Instalar dependencias: `composer install`
4. Acceder a: `http://localhost/MiniProyecto/public/index.php`

---

## 📝 Conclusiones

Este proyecto demuestra:
- Implementación correcta del patrón MVC
- Programación orientada a objetos con métodos estáticos
- Validación y sanitización de datos siguiendo OWASP
- Código limpio y reutilizable (DRY)
- Uso adecuado de estructuras de control
- Diseño moderno y responsivo
- Interactividad con JavaScript y Chart.js

El proyecto está listo para producción con enfoque en seguridad, mantenibilidad y experiencia del usuario.

---

**Última actualización:** 8 de Junio, 2026  
**Licencia:** MIT  
**Autor(es):** Solin Rodriguez, Ana Cheung, Carlos Diaz  
**Universidad:** Universidad Tecnológica de Panamá
