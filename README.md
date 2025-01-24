_Hemos ingresado a una nueva y pujante empresa orientada a la logística que es un flash. La misma se encarga de la realización de transportes de mercancias por todo el mundo y está en pleno proceso de digitalización de sus actividades. Somos el rookie así que tenemos que labrarnos una reputación._

Nuestra primera tarea consiste en escribir un query sql que alimente un reporte que permita a la oficina central conocer todos los viajes realizados. Se espera que este reporte muestre, por cada viaje, la cantidad de paquetes transportados y el total de dinero de sus tarifas. Los resultados deben venir ordenados del mas nuevo al mas viejo y ademas deben excluir los viajes con mas de 3 paquetes. Nota: solo deben escribir el query, no hacer el reporte.

> Ejercicio resuelto: https://www.mycompiler.io/view/7XDdqykYbTK

Al día siguiente notamos que el equipo backend se encuentra algo atareado así que decidimos hacer gala de nuestros conocimientos en PHP y ayudarlos. Nos cuentan que necesitan ayuda con el buscador de destinos. Estos destinos se encuentran organizados como una jerarquía en un árbol y dado que los mismos vienen de un servicio externo que siempre se encuentran cambiando, no pueden contar con que el árbol tenga siempre la misma cantidad de niveles y nos piden si podemos implementar la función que necesitan para buscar en el árbol. La misma recibe como argumentos, el árbol con los destinos y el texto a buscar (en cualquier parte del nombre).

> https://phpsandbox.io/n/hhrr-search-into-tree-gbizl (van a necesitar hacer un fork para editarlo)

> **Extra**: que en lugar de buscar por texto pueda recibir el criterio de búsqueda como función (función de orden superior)

Debido a nuestro buen trabajo el CTO de la empresa decide poner a prueba nuestras habilidades en JS con un desafio peculiar. Se nos da un json que incluye las facturas emitidas y se nos pide calcular el total adeudado (de las facturas no pagadas) por tipo de cliente. Ja pan comido... peeeero no se nos permite utilizar bucles (for, while, do while) ni el método forEach. Tampoco se permite utilizar recursividad, Gulp.

> https://replit.com/@IvanStadius/HHRR-Declaratividad#index.js (van a necesitar hacer un fork para editarlo)

Ahora sí, habiendo demostrado nuestra valía, se nos permite jugar con los chicos grandes. Vamos a participar del desarrollo  del core de la aplicación. Las reglas de negocio que nos importan son las siguientes:

* Existe la entidad camión, estos tienen un modelo y una patente.
* Cada modelo soporta un volumen(m3) y un peso máximo(kg)
* A los camiones se le puede asignar una única hoja de ruta a la vez.
* Las hojas de ruta agrupan **viajes y otras hojas de ruta** osea tienen n viajes/hojas de rutas (puede tener una combinación).
* Existen tres tipos de viajes: Normales, Prioritarios, Devoluciones.
* Los viajes tienen n paquetes, los paquetes tienen peso(kg), alto, ancho y largo(m).
* Los viajes tienen un origen y un destino, estos origenes y destinos tienen dirección y coordenadas (latitud y longitud)
* Las hojas de ruta, los viajes y los modelos son inmutables, una vez creados no se modifican.

A nosotros nos toca modelar estas entidades utilizando correctamente los principios de la programación orientada a objetos (herencia, composición, polimorfismo, etc...) y **crear un método que calcule el costo por hoja de ruta**. En caso de querer cargar en un camión una hoja de ruta que supere sus capacidades se debe arrojar una excepción. Las reglas para calcular el valor de un viaje son las siguientes:

* Si el viaje es Normal el costo son $2 x Kg x KM recorrido
* Si el viaje es Prioritario el costo es el mayor entre estos dos
    * $4 * Kg x KM recorrido
    * $10 * M3(volumen) * KM recorrido
* Si el viaje es Devolución se cobra una tarifa plana de $1000
* Para calcular los kilómetros recorridos se calcula la distancia en linea recta entre las coordenadas de origen y de destino. Para hacer eso hay muchas funciones en internet, dejamos una que pueden usar al final de este documento.

ESTE EJERCICIO NO REQUIERE CREAR PERSISTENCIA, ENDPOINTS, FRONT, NI USAR NINGÚN FRAMEWORK (AUNQUE ESTO ÚLTIMO NO ESTA PROHIBIDO TAMPOCO), EL OBJETIVO ES DEMOSTRAR SUS CONOCIMIENTOS EN ORIENTACIÓN A OBJETOS

OBLIGATORIO: Utilizar php tipado, en los metodos. Tanto para los parámetros como para los valores devueltos.

> Este ejercicio puede desarrolarse en https://phpsandbox.io o en el ide/entorno de su preferencia

> **Extra**: Desarrollar algunos unit test, no es necesario tener una gran cobertura, solo demostrar que se tienen los conocimientos.

> **Extra**:  Utilizar phpdoc para documentar

> **Obligatorio**: Crear diagrama UML de clases

## Entrega
* La entrega de la prueba técnica es por email (a la misma dirección desde el cual se envio el link a este repositorio) y el código puede estar en:
    * Los IDEs online suministrados en cuyo caso solo vamos a requerir los links.
    * Un zip con todos los archivos adjunto al email.
    * O en un repo de GIT

* No es necesario completar el 100% de la prueba para enviarla, hagan hasta donde puedan. Ademas los puntos **Extra** son opcionales.



### Cálculo de distancia


```
function getDistanceBetweenPoints(float $latitude1, float $longitude1, float $latitude2, float $longitude2) : float {
    $theta = $longitude1 - $longitude2; 
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515; 
    $distance = $distance * 1.609344;
    return (round($distance,2)); 
}
```
