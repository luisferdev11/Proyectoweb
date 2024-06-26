
### Consultas para `Persona`

#### Crear una nueva persona
```sql
INSERT INTO Persona (Nombre, ApellidoMaterno, ApellidoPaterno, FechaNacimiento, Correo, Telefono, Clave)
VALUES ('Juan', 'Pérez', 'González', '1985-05-20', 'juan.perez@example.com', 1234567890, 'hashed_password');
```

#### Obtener una persona por ID
```sql
SELECT * FROM Persona WHERE id_persona = 1;
```

#### Actualizar una persona
```sql
UPDATE Persona
SET Nombre = 'Juan', ApellidoMaterno = 'Pérez', ApellidoPaterno = 'González', FechaNacimiento = '1985-05-20', Correo = 'juan.perez@example.com', Telefono = 1234567890, Clave = 'new_hashed_password'
WHERE id_persona = 1;
```

#### Eliminar una persona
```sql
DELETE FROM Persona WHERE id_persona = 1;
```

### Consultas para `Cliente`

#### Crear un nuevo cliente
```sql
INSERT INTO Cliente (id_persona)
VALUES (1);
```

#### Obtener un cliente por ID
```sql
SELECT * FROM Cliente WHERE id_cliente = 1;
```

### Consultas para `Direccion`

#### Crear una nueva dirección
```sql
INSERT INTO Direccion (id_cliente, Direccion)
VALUES (1, '123 Main St, Ciudad de México');
```

#### Obtener una dirección por ID
```sql
SELECT * FROM Direccion WHERE id_direccion = 1;
```

### Consultas para `Bodega`

#### Crear una nueva bodega
```sql
INSERT INTO Bodega (Ubicacion, CapacidadBodega)
VALUES ('Zona Industrial', '200m2');
```

#### Obtener una bodega por ID
```sql
SELECT * FROM Bodega WHERE id_bodega = 1;
```

### Consultas para `Inventario`

#### Crear un nuevo inventario
```sql
INSERT INTO Inventario (id_bodega, Producto, CantidadDisponible, UnidadMedida, CantidadMinima, CantidadMaxima)
VALUES (1, 'Tubo PVC 1"', 100, 'metros', 10, 200);
```

#### Obtener inventario por ID
```sql
SELECT * FROM Inventario WHERE id_inventario = 1;
```

#### Actualizar inventario
```sql
UPDATE Inventario
SET CantidadDisponible = 90, FechaUltimaActualizacion = CURRENT_TIMESTAMP
WHERE id_inventario = 1;
```

### Consultas para `Suministro`

#### Crear un nuevo suministro
```sql
INSERT INTO Suministro (NumeroEmpleado, Producto, CantidadAsignada, UnidadMedida)
VALUES (123, 'Tubo PVC 1"', 50, 'metros');
```

#### Obtener suministro por ID
```sql
SELECT * FROM Suministro WHERE id_suministro = 1;
```

### Consultas para `Peticion`

#### Crear una nueva petición
```sql
INSERT INTO Peticion (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado)
VALUES (1, 1, 'Instalación', 'Instalación de tinaco nuevo', 'Traer herramientas', '2024-07-01', '10:00:00', '2024-06-25', 'Pendiente');
```

#### Obtener una petición por ID
```sql
SELECT * FROM Peticion WHERE id_peticion = 1;
```

#### Actualizar una petición
```sql
UPDATE Peticion
SET Estado = 'Completado'
WHERE id_peticion = 1;
```

### Consultas para `Servicio`

#### Crear un nuevo servicio
```sql
INSERT INTO Servicio (id_empleado, id_peticion, TipoServicio, Horainicio, Horafin, Estado, Costo, Precio, Calificacion, Observaciones)
VALUES (1, 1, 'Instalación', '10:00:00', '12:00:00', 'En Progreso', 1000, 1200, NULL, 'Sin observaciones');
```

#### Obtener un servicio por ID
```sql
SELECT * FROM Servicio WHERE id_servicio = 1;
```

#### Actualizar un servicio
```sql
UPDATE Servicio
SET Estado = 'Completado', Horafin = '12:30:00', Calificacion = 5, Observaciones = 'Trabajo bien hecho'
WHERE id_servicio = 1;
```

### Consultas para `MetodoPago`

#### Crear un nuevo método de pago
```sql
INSERT INTO MetodoPago (NumeroTarjeta, NombreTitular, FechaExpiracion, CVV)
VALUES (1234567890123456, 'Juan Pérez', '2025-12-31', '123');
```

#### Obtener un método de pago por número de tarjeta
```sql
SELECT * FROM MetodoPago WHERE NumeroTarjeta = 1234567890123456;
```

### Consultas para `PeticionMetodoPago`

#### Asociar un método de pago a una petición
```sql
INSERT INTO PeticionMetodoPago (id_peticion, NumeroTarjeta, Estado)
VALUES (1, 1234567890123456, 'Pagado');
```

#### Obtener método de pago asociado a una petición
```sql
SELECT * FROM PeticionMetodoPago WHERE id_peticion = 1;
```

### Consultas para `Empleado`

#### Crear un nuevo empleado
```sql
INSERT INTO Empleado (id_persona, id_bodega, NumeroEmpleado, Especializacion)
VALUES (1, 1, 'EMP123', 'Instalador');
```

#### Obtener un empleado por ID
```sql
SELECT * FROM Empleado WHERE id_empleado = 1;
```


### Consultas para `Disponibilidad`

#### Crear una nueva disponibilidad
```sql
INSERT INTO Disponibilidad (id_empleado, Fecha, HoraInicio, HoraFin)
VALUES (1, '2024-07-01', '09:00:00', '17:00:00');
```

#### Obtener disponibilidad por ID
```sql
SELECT * FROM Disponibilidad WHERE id_disponibilidad = 1;
```


### Consultas para `Cursos`

#### Crear un nuevo curso
```sql
INSERT INTO Cursos (id_curso, Nombre, Organizacion, NumeroEmpleado, FechaExpedicion, FechaExpiracion, Descripcion)
VALUES (1, 'Curso de Seguridad', 'Organización X', 123, '2024-06-01', '2025-06-01', 'Curso sobre seguridad en el trabajo');
```

#### Obtener un curso por ID
```sql
SELECT * FROM Cursos WHERE id_curso = 1;
```






Claro, aquí tienes algunos ejemplos de cómo utilizar los triggers de historial para registrar cambios en las tablas `Peticion` y `Servicio`. Estos ejemplos muestran cómo se insertan, actualizan y eliminan registros en estas tablas, y cómo los triggers correspondientes generan entradas en las tablas de historial.

### Ejemplo de Uso de Triggers de Historial

#### Insertar una Nueva Petición
```sql
-- Insertar una nueva petición
INSERT INTO Peticion (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado)
VALUES (1, 1, 'Instalación', 'Instalación de tinaco nuevo', 'Traer herramientas', '2024-07-01', '10:00:00', '2024-06-25', 'Pendiente');
```

#### Actualizar una Petición (Trigger se Activa)
```sql
-- Actualizar una petición (esto activará el trigger y generará una entrada en HistorialPeticion)
UPDATE Peticion
SET Estado = 'Completado'
WHERE id_peticion = 1;
```

#### Consultar Historial de Petición
```sql
-- Consultar el historial de una petición específica
SELECT * FROM HistorialPeticion WHERE id_peticion = 1;
```

#### Insertar un Nuevo Servicio
```sql
-- Insertar un nuevo servicio
INSERT INTO Servicio (id_empleado, id_peticion, TipoServicio, Horainicio, Horafin, Estado, Costo, Precio, Calificacion, Observaciones)
VALUES (1, 1, 'Instalación', '10:00:00', '12:00:00', 'En Progreso', 1000, 1200, NULL, 'Sin observaciones');
```

#### Actualizar un Servicio (Trigger se Activa)
```sql
-- Actualizar un servicio (esto activará el trigger y generará una entrada en HistorialServicio)
UPDATE Servicio
SET Estado = 'Completado', Horafin = '12:30:00', Calificacion = 5, Observaciones = 'Trabajo bien hecho'
WHERE id_servicio = 1;
```

#### Consultar Historial de Servicio
```sql
-- Consultar el historial de un servicio específico
SELECT * FROM HistorialServicio WHERE id_servicio = 1;
```

### Explicación de los Triggers

Los triggers definidos en el script se activan después de que se actualice una fila en las tablas `Peticion` y `Servicio`. Cada vez que una de estas tablas es actualizada, el trigger correspondiente inserta un registro en la tabla de historial respectiva (`HistorialPeticion` o `HistorialServicio`) con los datos anteriores de la fila actualizada.