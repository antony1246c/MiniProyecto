# Mini Proyecto PHP - Programación Orientada a Objetos

## Descripción

Aplicación web desarrollada en PHP siguiendo el patrón MVC, Programación Orientada a Objetos (POO) y estándares PSR-4. El proyecto implementa nueve problemas matemáticos y estadísticos utilizando clases reutilizables, validación de datos, sanitización de entradas y una interfaz moderna con navegación tipo SPA.

---

## Problemas Implementados

### Problema 1: Estadísticos

Calcula la media, desviación estándar, valor mínimo y valor máximo de cinco números.

* Clase: `Estadisticos`
* Método: `calcular(array $numeros)`

### Problema 2: Suma de Números Consecutivos

Calcula la suma de números consecutivos utilizando la fórmula de Gauss.

* Clase: `SumaNumeros`
* Método: `calcular(int $primero, int $ultimo, int $n)`

### Problema 3: Múltiplos de 4

Genera los primeros N múltiplos de 4.

* Clase: `Multiplos`
* Método: `calcular(int $cantidad)`

### Problema 4: Pares e Impares

Calcula por separado la suma de los números pares e impares entre 1 y 200 utilizando estructuras iterativas.

### Problema 5: Clasificación de Edades

Clasifica cinco edades en las categorías:

* Niño
* Adolescente
* Adulto
* Adulto Mayor

Incluye gráfica de pastel interactiva con Chart.js.

### Problema 6: Presupuesto Hospitalario

Distribuye un presupuesto entre los departamentos:

* Ginecología: 40%
* Traumatología: 35%
* Pediatría: 25%

Incluye gráfica de pastel interactiva con Chart.js.

### Problema 7: Calculadora de Datos Estadísticos

Permite al usuario indicar cuántas notas desea ingresar y calcula:

* Media
* Desviación estándar
* Valor mínimo
* Valor máximo

Utiliza `foreach` para recorrer la colección de datos.

### Problema 8: Estación del Año

Determina la estación del año según la fecha ingresada.

* Clase: `EstacionAnio`
* Utiliza `switch` y operadores ternarios
* Muestra una imagen representativa de la estación

### Problema 9: Potencias

Solicita un número del 1 al 9 y genera sus primeras 15 potencias.

* Clase: `Potencias`
* Método: `calcular(int $base, int $limite = 15)`

---

## Seguridad y OWASP

### Prevención de XSS (OWASP A03:2021)

```php
public static function sanitizar(string $valor): string
{
    return htmlspecialchars(strip_tags(trim($valor)));
}
```

Características:

* Eliminación de espacios innecesarios mediante `trim()`
* Eliminación de etiquetas HTML/PHP con `strip_tags()`
* Conversión de caracteres especiales usando `htmlspecialchars()`

### Validación de Entradas

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

* Validación mediante `filter_var()`
* Restricción de valores negativos
* Manejo seguro de errores

### Manejo Seguro de Errores

```php
elseif ($problema >= 1 && $problema <= 9) {
    include __DIR__ . "/views/p{$problema}.php";
} else {
    echo '<div class="text">Problema no encontrado.</div>';
}
```

Se evita exponer rutas internas o información sensible del servidor.

---

## Funciones Matemáticas Implementadas

### Estadísticos

* Media: Σx / n
* Varianza: Σ(x − media)² / n
* Desviación estándar: √varianza

### Suma de Números Consecutivos

```php
return ($n * ($primero + $ultimo)) / 2;
```

### Múltiplos de 4

```php
for ($i = 1; $i <= $cantidad; $i++) {
    $resultado[] = 4 * $i;
}
```

### Potencias

```php
for ($i = 1; $i <= $limite; $i++) {
    $resultado[] = [
        'exponente' => $i,
        'valor' => pow($base, $i)
    ];
}
```

### Presupuesto Hospitalario

```php
return [
    'Ginecologia 40%'   => $cantidad * 0.40,
    'Traumatologia 35%' => $cantidad * 0.35,
    'Pediatria 25%'     => $cantidad * 0.25
];
```

---

## Clase Utilidades

Namespace:

```php
Samar\MiniProyecto
```

### Métodos Disponibles

#### sanitizar()

* Elimina espacios en blanco
* Elimina etiquetas HTML/PHP
* Convierte caracteres especiales

#### validarNumeroPositivo()

* Valida números flotantes
* Rechaza valores negativos

#### validarNumerosPositivos()

* Valida arreglos completos
* Retorna `null` si algún dato es inválido

---

## Principios Aplicados

| Principio | Implementación                            |
| --------- | ----------------------------------------- |
| MVC       | Separación entre Model, View y Controller |
| POO       | Clases y métodos estáticos                |
| PSR-1     | Convenciones de nomenclatura              |
| PSR-4     | Autoloading con Composer                  |
| DRY       | Reutilización de componentes              |
| OWASP     | Sanitización y validación de datos        |

---

## Características de la Aplicación

* Diseño responsivo con CSS Grid
* Modo Claro/Oscuro
* Persistencia de preferencias con LocalStorage
* Gráficas interactivas con Chart.js
* Sidebar colapsable
* Navegación SPA mediante Fetch API
* Uso de History API (`pushState`)
* Footer dinámico con fecha actual

---

## Estructuras de Control Utilizadas

* `if / elseif / else`
* `switch / case`
* `for`
* `foreach`
* Operadores ternarios

---

## Instalación

### Requisitos

* PHP 7.4 o superior
* Composer
* Apache (WAMP/XAMPP) o Nginx

### Pasos

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

## Conclusiones

* Implementación correcta del patrón MVC.
* Aplicación de Programación Orientada a Objetos mediante clases reutilizables.
* Uso de namespaces y autoloading PSR-4 con Composer.
* Validación y sanitización de entradas siguiendo recomendaciones OWASP.
* Código modular y mantenible aplicando el principio DRY.
* Implementación de navegación SPA utilizando Fetch API e History API.
* Visualización de datos mediante gráficas interactivas con Chart.js.
* Interfaz moderna con soporte para modo claro y oscuro.

---

## Autores

* Solin Rodriguez
* Ana Cheung
* Carlos Diaz

## Universidad

Universidad Tecnológica de Panamá (UTP)

---

**Última actualización:** Junio 2026
