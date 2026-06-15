# Mini Proyecto PHP - Programación Orientada a Objetos

## Introducción

El presente proyecto fue desarrollado como parte del curso de Programación Orientada a Objetos de la Universidad Tecnológica de Panamá. Su objetivo es aplicar conceptos fundamentales de programación orientada a objetos utilizando PHP, implementando estructuras de control condicionales y repetitivas, funciones matemáticas, validación de datos, sanitización de entradas, métodos estáticos y reutilización de código mediante el principio DRY.

Además, el proyecto utiliza una arquitectura basada en MVC (Modelo - Vista - Controlador), permitiendo una mejor organización del código, mayor mantenibilidad y escalabilidad de la aplicación. Durante su desarrollo se aplicaron buenas prácticas recomendadas por los estándares PSR-1, PSR-4 y recomendaciones de seguridad basadas en OWASP.

---

# Información Académica

**Universidad:** Universidad Tecnológica de Panamá (UTP)

**Facultad:** Facultad de Ingeniería de Sistemas Computacionales

**Curso:** Programación Orientada a Objetos

**Grupo:** 1GS131

**Docente:** Ing. Irina Fong

**Período Académico:** 2026

### Integrantes

- Solin Rodriguez
- Ana Cheung
- Carlos Diaz

---

# Descripción

Aplicación web desarrollada en PHP siguiendo el patrón MVC, Programación Orientada a Objetos (POO) y los estándares PSR-1 y PSR-4. El proyecto implementa diversos problemas matemáticos y estadísticos utilizando clases reutilizables, validación de datos, sanitización de entradas y una interfaz moderna con navegación tipo SPA.

---

# Problemas Implementados

## Problema 1: Estadísticos

Calcula la media, desviación estándar, valor mínimo y valor máximo de cinco números.

- Clase: `Estadisticos`
- Método: `calcular(array $numeros)`

## Problema 2: Suma de Números Consecutivos

Calcula la suma de números consecutivos utilizando la fórmula de Gauss.

- Clase: `SumaNumeros`
- Método: `calcular(int $primero, int $ultimo, int $n)`

## Problema 3: Múltiplos de 4

Genera los primeros N múltiplos de 4.

- Clase: `Multiplos`
- Método: `calcular(int $cantidad)`

## Problema 4: Pares e Impares

Calcula por separado la suma de los números pares e impares entre 1 y 200 utilizando estructuras iterativas.

## Problema 5: Clasificación de Edades

Clasifica cinco edades en las categorías:

- Niño
- Adolescente
- Adulto
- Adulto Mayor

Incluye gráfica de pastel interactiva con Chart.js.

## Problema 6: Presupuesto Hospitalario

Distribuye un presupuesto entre los departamentos:

- Ginecología: 40%
- Traumatología: 35%
- Pediatría: 25%

Incluye gráfica de pastel interactiva con Chart.js.

## Problema 7: Calculadora de Datos Estadísticos

Permite al usuario indicar cuántas notas desea ingresar y calcula:

- Media
- Desviación estándar
- Valor mínimo
- Valor máximo

Utiliza `foreach` para recorrer la colección de datos.

## Problema 8: Estación del Año

Determina la estación del año según la fecha ingresada.

- Clase: `EstacionAnio`
- Método: `calcular(string $fecha)`
- Utiliza `switch`
- Utiliza operadores ternarios
- Muestra una imagen representativa de la estación

## Problema 9: Potencias

Solicita un número del 1 al 9 y genera sus primeras 15 potencias.

- Clase: `Potencias`
- Método: `calcular(int $base, int $limite = 15)`

---

# Arquitectura del Proyecto

El proyecto fue desarrollado siguiendo el patrón MVC (Modelo - Vista - Controlador).

```text
MiniProyecto/
│
├── public/
│   ├── index.php
│   ├── assets/
│   └── Procesos/
│
├── src/
│   ├── Components/
│   ├── Procedimientos/
│   └── Utilidades/
│
├── views/
│
├── vendor/
│
└── composer.json
```

### Componentes Principales

- **Views:** Interfaces mostradas al usuario.
- **Procesos:** Recepción y validación de datos.
- **Procedimientos:** Lógica de negocio y resolución de problemas.
- **Utilidades:** Validaciones, sanitización y funciones reutilizables.

---

# Seguridad y OWASP

## Prevención de XSS (OWASP A03:2021 - Injection)

```php
public static function sanitizar(string $valor): string
{
    return htmlspecialchars(strip_tags(trim($valor)));
}
```

Características:

- Eliminación de espacios mediante `trim()`.
- Eliminación de etiquetas HTML y PHP mediante `strip_tags()`.
- Conversión de caracteres especiales mediante `htmlspecialchars()`.
- Prevención de ataques XSS (Cross-Site Scripting).

---

## Validación de Entradas

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

Características:

- Validación utilizando `filter_var()`.
- Restricción de números negativos.
- Sanitización automática de datos.
- Manejo seguro de errores.

---

## Validación de Fechas

```php
public static function validarFecha(string $fecha): bool
{
    return preg_match(
        '/^\d{4}-\d{2}-\d{2}$/',
        $fecha
    ) === 1;
}
```

Características:

- Uso de expresiones regulares mediante `preg_match()`.
- Verificación del formato AAAA-MM-DD.
- Prevención de entradas inválidas.

---

## Gestión Segura de Errores

```php
if ($cantidad === null || $cantidad < 1) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Ingresa un número entero positivo válido.'
    ]);
    exit;
}
```

También se implementan casos por defecto para evitar errores inesperados:

```php
default:
    $estacion = 'Desconocida';
```

Esto evita exponer rutas internas, errores de PHP o información sensible al usuario final.

---

# Clase Utilidades

Namespace:

```php
namespace Samar\MiniProyecto\Utilidades;
```

La clase Utilidades centraliza la lógica de validación, sanitización y operaciones matemáticas reutilizables, aplicando el principio DRY.

## Métodos Disponibles

### sanitizar()

- Elimina espacios en blanco con `trim()`.
- Elimina etiquetas HTML/PHP con `strip_tags()`.
- Convierte caracteres especiales mediante `htmlspecialchars()`.

### validarNumeroPositivo()

- Valida números mediante `filter_var()`.
- Rechaza valores negativos.
- Sanitiza automáticamente la entrada.

### validarNumerosPositivos()

- Valida arreglos completos.
- Reutiliza internamente `validarNumeroPositivo()`.
- Retorna `null` si algún dato es inválido.

### validarFecha()

- Valida fechas utilizando `preg_match()`.
- Verifica el formato AAAA-MM-DD.

### potencia()

```php
public static function potencia(
    float $base,
    int $exponente
): float
{
    return pow($base, $exponente);
}
```

- Encapsula la función matemática `pow()`.
- Reutilizada por las clases `Potencias` y `Estadisticos`.

### raizCuadrada()

```php
public static function raizCuadrada(float $numero): float
{
    return sqrt($numero);
}
```

- Encapsula la función matemática `sqrt()`.
- Utilizada para calcular la desviación estándar.

---

# Funciones Matemáticas Implementadas

## Estadísticos

- Media = Σx / n
- Varianza = Σ(x − media)² / n
- Desviación estándar = √varianza

La clase utiliza:

```php
Utilidades::potencia()
Utilidades::raizCuadrada()
```

## Suma de Números Consecutivos

Fórmula de Gauss:

```php
return ($n * ($primero + $ultimo)) / 2;
```

## Múltiplos de 4

```php
for ($i = 1; $i <= $cantidad; $i++) {
    $resultado[] = 4 * $i;
}
```

## Potencias

```php
for ($i = 1; $i <= $limite; $i++) {
    $resultado[] = [
        'exponente' => $i,
        'valor' => Utilidades::potencia($base, $i)
    ];
}
```

## Presupuesto Hospitalario

```php
return [
    'Ginecologia 40%'   => $cantidad * 0.40,
    'Traumatologia 35%' => $cantidad * 0.35,
    'Pediatria 25%'     => $cantidad * 0.25
];
```

---

# Aplicación del Principio DRY

Se aplicó el principio DRY (Don't Repeat Yourself) evitando la duplicación de código mediante componentes y funciones reutilizables.

## Reutilización de Validaciones

```php
Utilidades::sanitizar()
Utilidades::validarNumeroPositivo()
Utilidades::validarNumerosPositivos()
Utilidades::validarFecha()
```

## Reutilización de Funciones Matemáticas

```php
Utilidades::potencia()
Utilidades::raizCuadrada()
```

## Reutilización de Componentes

- header.php
- footer.php

Beneficios obtenidos:

- Menor duplicación de código.
- Mayor mantenibilidad.
- Código más limpio y escalable.

---

# Estándares PSR Aplicados

## PSR-1

### Clases (StudlyCaps)

```php
Estadisticos
Potencias
Presupuesto
EstacionAnio
Multiplos
Utilidades
```

### Métodos (camelCase)

```php
calcular()
calcularPresupuesto()
validarNumeroPositivo()
validarNumerosPositivos()
validarFecha()
raizCuadrada()
```

## PSR-4

Implementado mediante Composer:

```json
{
    "autoload": {
        "psr-4": {
            "Samar\\MiniProyecto\\": "src/"
        }
    }
}
```

Beneficios:

- Carga automática de clases.
- Organización modular.
- Uso de namespaces.
- Mayor mantenibilidad.

---

# Estructuras de Control Utilizadas

- if
- elseif
- else
- switch
- case
- for
- foreach
- Operadores ternarios

Ejemplos:

- `switch` en EstacionAnio.
- `foreach` en Estadisticos y Utilidades.
- `for` en Multiplos y Potencias.
- Operadores ternarios en EstacionAnio.

---

# Tecnologías Utilizadas

- PHP 8
- Composer
- HTML5
- CSS3
- JavaScript
- Fetch API
- History API
- Chart.js

---

# Características de la Aplicación

- Diseño responsivo.
- Modo Claro/Oscuro.
- Persistencia mediante LocalStorage.
- Gráficas interactivas con Chart.js.
- Sidebar colapsable.
- Navegación SPA mediante Fetch API.
- Uso de History API (`pushState`).
- Footer dinámico con fecha actual.

---

# Instalación

## Requisitos

- PHP 7.4 o superior.
- Composer.
- Apache (XAMPP/WAMP) o Nginx.

## Pasos

```bash
git clone https://github.com/antony1246c/MiniProyecto
cd MiniProyecto
composer install
```

Acceder desde:

```text
http://localhost/MiniProyecto/public/index.php
```

---

# Conclusiones

- Implementación correcta del patrón MVC.
- Aplicación de Programación Orientada a Objetos mediante clases reutilizables.
- Uso de namespaces y autoloading PSR-4 con Composer.
- Aplicación de recomendaciones OWASP mediante `htmlspecialchars()`, `filter_var()` y `preg_match()`.
- Centralización de validaciones y funciones matemáticas en la clase Utilidades.
- Aplicación del principio DRY mediante reutilización de componentes y métodos estáticos.
- Uso de estructuras de control condicionales y repetitivas para resolver problemas algorítmicos.
- Implementación de navegación SPA utilizando Fetch API e History API.
- Visualización de datos mediante gráficas interactivas con Chart.js.
- Interfaz moderna con soporte para modo claro y oscuro.

---

# Autores

- Solin Rodriguez
- Ana Cheung
- Carlos Diaz

## Universidad

Universidad Tecnológica de Panamá (UTP)

**Grupo:** 1GS131

**Última actualización:** Junio 2026
