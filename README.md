---

## 🎯 Problemas Implementados

### Problema 1: Estadísticos (Media, Desviación Estándar, Mín, Máx)
- Calcula estadísticas de 5 números
- Clase: `Estadisticos`
- Método: `calcular(array $numeros)`

### Problema 2: Suma del 1 al 1000
- Suma de números consecutivos usando fórmula de Gauss
- Clase: `SumaNumeros`
- Método: `calcular(int $primero, int $ultimo, int $n)`

### Problema 3: Múltiplos de 4
- Calcula N primeros múltiplos de 4
- Clase: `Multiplos`
- Método: `calcular(int $cantidad)`

### Problema 4: Pares e Impares
- Calcula independientemente la suma de pares e impares entre 1 y 200
- Lógica iterativa con `for`

### Problema 5: Clasificación de Edades ⭐
- Clasifica 5 edades en categorías (Niño, Adolescente, Adulto, Adulto Mayor)
- Clase: `Edades`
- Gráfica de pastel interactiva con Chart.js

### Problema 6: Presupuesto Hospitalario ⭐
- Distribuye presupuesto entre departamentos (Ginecología 40%, Traumatología 35%, Pediatría 25%)
- Clase: `Presupuesto`
- Gráfica de pastel interactiva con Chart.js

### Problema 7: Calculadora de Datos Estadísticos
- El usuario define cuántas notas ingresar, luego calcula media, desviación estándar, mín y máx
- Usa `foreach` para recorrer la colección de notas

### Problema 8: Estación del Año ⭐
- Determina la estación según la fecha ingresada
- Clase: `EstacionAnio`
- **Usa `switch($mes)` con casos múltiples y operadores ternarios para días de transición**
- Muestra imagen representativa de la estación

### Problema 9: Potencias
- Solicita un número del 1 al 9 y genera sus 15 primeras potencias
- Clase: `Potencias`
- Método: `calcular(int $base, int $limite = 15)`

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
- Se usa en todos los scripts de `Procesos/` antes de procesar datos del usuario
- `htmlspecialchars()` convierte caracteres especiales a entidades HTML
- `strip_tags()` elimina etiquetas HTML/PHP maliciosas
- `trim()` elimina espacios innecesarios

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
- Si la validación falla, retorna `null` y devuelve error JSON al frontend

#### Ejemplo en `calcular_edades.php`:
```php
$numeros = Utilidades::validarNumerosPositivos($raw);
if ($numeros === null || count($numeros) !== 5) {
    echo json_encode(['success' => false, 'mensaje' => 'Ingresa exactamente 5 edades válidas.']);
    exit;
}
```

### Error Handling Seguro

```php
// En index.php
elseif ($problema >= 1 && $problema <= 9) {
    include __DIR__ . "/views/p{$problema}.php";
} else {
    echo '<div class="text">Problema no encontrado.</div>';
}
```

- Valida que `?p` sea un entero entre 1 y 9
- Si es inválido, muestra mensaje genérico sin exponer rutas internas ni errores de PHP

---

## 🧮 Funciones Matemáticas

### Estadísticos (Clase: `Estadisticos`)
```php
public static function calcular(array $numeros): array
{
    $n = count($numeros);
    $media = array_sum($numeros) / $n;
    $varianza = array_sum(
        array_map(fn($x) => pow($x - $media, 2), $numeros)
    ) / $n;

    return [
        'media'    => round($media, 2),
        'desv_std' => round(sqrt($varianza), 2),
        'min'      => min($numeros),
        'max'      => max($numeros)
    ];
}
```

**Fórmulas aplicadas:**
- Media: `Σx / n`
- Varianza: `Σ(x - media)² / n`
- Desviación estándar: `√varianza` usando `sqrt()`

### Suma de Números Consecutivos (Clase: `SumaNumeros`)
```php
public static function calcular(int $primero, int $ultimo, int $n): int
{
    // Fórmula de Gauss: n(primero + último) / 2
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

### Clase: `Utilidades` — Namespace: `Samar\MiniProyecto`

#### Método 1: `sanitizar(string $valor): string`
```php
// - trim(): Elimina espacios en blanco
// - strip_tags(): Elimina etiquetas HTML/PHP
// - htmlspecialchars(): Convierte caracteres especiales a entidades HTML seguras
return htmlspecialchars(strip_tags(trim($valor)));
```

#### Método 2: `validarNumeroPositivo(string $valor): ?float`
```php
// - Sanitiza primero
// - Valida con filter_var(FILTER_VALIDATE_FLOAT)
// - Verifica que sea >= 0
// - Retorna null si falla la validación
```

#### Método 3: `validarNumerosPositivos(array $valores): ?array`
```php
// - Valida cada elemento del array individualmente
// - Retorna null si cualquier elemento falla
```

---

## 📊 Características Principales

### ✨ Principios Aplicados

| Principio  | Implementación                                                              |
|------------|-----------------------------------------------------------------------------|
| **MVC**    | Model (`src/Procedimientos/`), View (`views/*.php`), Controller (`index.php`) |
| **POO**    | Clases con métodos estáticos bajo namespace `Samar\MiniProyecto`            |
| **PSR-1**  | StudlyCaps para clases, camelCase para métodos y variables                  |
| **PSR-4**  | Autoloading con Composer, namespace `Samar\MiniProyecto\Procedimientos`     |
| **DRY**    | Componentes reutilizables: `header.php`, `footer.php`, `Utilidades`         |
| **OWASP**  | Sanitización, validación con `filter_var`, error handling seguro            |

### 🎨 Características Visuales
- Diseño responsivo con CSS Grid
- Modo Light/Dark con persistencia en `localStorage`
- Gráficas de pastel interactivas con Chart.js
- Sidebar colapsable con estado persistente
- Navegación SPA con `fetch` y `history.pushState` sin recargar la página
- Footer dinámico con fecha actual del día

### 🔄 Estructuras de Control
- ✅ `if` / `elseif` / `else`
- ✅ `switch` / `case` (`EstacionAnio`, `Edades`)
- ✅ `for` (Múltiplos, Potencias)
- ✅ `foreach` (Estadísticos, validación de arrays)
- ✅ Operadores ternarios (transiciones de estación por día)

---

## 🚀 Instalación y Uso

### Requisitos
- PHP 7.4+
- Servidor web (Apache con WAMP/XAMPP o Nginx)
- Composer

### Pasos
1. Clonar el repositorio: `git clone https://github.com/antony1246c/MiniProyecto`
2. Navegar a la carpeta: `cd MiniProyecto`
3. Instalar dependencias: `composer install`
4. Acceder a: `http://localhost/MiniProyecto/public/index.php`

---

## 📝 Conclusiones

Este proyecto demuestra:
- Implementación del patrón MVC con separación clara de responsabilidades
- Programación orientada a objetos con métodos estáticos y namespaces PSR-4
- Validación y sanitización de datos siguiendo las recomendaciones OWASP A03:2021
- Código limpio y reutilizable aplicando el principio DRY
- Uso adecuado de estructuras de control: `if`, `switch`, `for`, `foreach` y operadores ternarios
- Navegación tipo SPA sin recarga de página usando `fetch` y `history.pushState`
- Gráficas interactivas con Chart.js con manejo correcto de instancias
- Diseño moderno con modo claro/oscuro persistente

---

**Última actualización:** Junio 2026  
**Autores:** Solin Rodriguez, Ana Cheung, Carlos Diaz  
**Universidad:** Universidad Tecnológica de Panamá
