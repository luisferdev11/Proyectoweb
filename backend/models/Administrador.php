<?php

require_once __DIR__ . '/Persona.php';

class Administrador extends Persona {
    private string $table_bodega = 'Bodega';
    private string $table_cliente = 'Cliente';
    private string $table_direccion = 'Direccion';
    private string $table_peticion = 'Peticion';
    private string $table_metodo_pago = 'MetodoPago';
    private string $table_peticion_metodo_pago = 'PeticionMetodoPago';
    private string $table_servicio = 'Servicio';
    private string $table_empleado = 'Empleado';
    private string $NumeroEmpleado;
    private string $Bodega;
    private string $Especializacion;

    public function __construct(PDO $db) {
        parent::__construct($db);
    }

    public function register(): bool {
        if ($this->create()) {
            $query = 'INSERT INTO ' . $this->table_empleado . ' (id_persona,id_bodega,numeroempleado, especializacion) VALUES VALUES (:id_persona, bodega, numeroempleado, especializacion  )';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $this->id_persona);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->errorInfo()[2]);
        }

        return false;
    }

    public function getById(int $id): ?array {
        $query = 'SELECT e.*, p.* FROM ' . $this->table_empleado . ' e 
                  JOIN ' . $this->table . ' p ON e.id_persona = p.id_persona 
                  WHERE e.id_persona = :id_persona';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }


    

    public function login(string $correo, string $contrasena): ?array {
        $query = 'SELECT e.id_empleado, e.id_bodega, p.* FROM ' . $this->table_empleado . ' e
                  JOIN ' . $this->table . ' p ON e.id_persona = p.id_persona 
                  WHERE p.correo = :correo AND p.clave = :contrasena AND e.especializacion = \'Administrador\'';
        
        $stmt = $this->conn->prepare($query);
    
        // Asignar valores a los marcadores de posición
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
    
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si se encontró un usuario
        if (!$user) {
            error_log("Usuario no encontrado: " . $correo);
            return null;
        }
    
        // Verificar la contraseña (si es necesario)
        /*
        $hash = $user['clave'];
        if (!password_verify($contrasena, $hash)) {
            error_log("Contraseña incorrecta para el usuario: " . $correo);
            return null;
        }
        */
    
        // Devolver el usuario encontrado
        return $user;
    }
    


    public function update(array $data): bool {
        try {
            // Inicia una transacción
            $this->conn->beginTransaction();
    
            // Primera consulta para la tabla principal
            $query1 = 'UPDATE ' . $this->table . ' 
                       SET Nombre = :Nombre, ApellidoMaterno = :ApellidoMaterno, ApellidoPaterno = :ApellidoPaterno, 
                           FechaNacimiento = :FechaNacimiento, Correo = :Correo, Telefono = :Telefono 
                       WHERE id_persona = :id_persona';
    
            $stmt1 = $this->conn->prepare($query1);
    
            $stmt1->bindParam(':Nombre', $data['Nombre']);
            $stmt1->bindParam(':ApellidoMaterno', $data['ApellidoMaterno']);
            $stmt1->bindParam(':ApellidoPaterno', $data['ApellidoPaterno']);
            $stmt1->bindParam(':FechaNacimiento', $data['FechaNacimiento']);
            $stmt1->bindParam(':Correo', $data['Correo']);
            $stmt1->bindParam(':Telefono', $data['Telefono']);
            $stmt1->bindParam(':id_persona', $data['id_persona']);
    
            $result1 = $stmt1->execute();
    
            // Segunda consulta para la tabla de empleados
            $query2 = 'UPDATE ' . $this->table_empleado . ' 
                       SET id_bodega = :Bodega, numeroempleado = :numeroempleado, especializacion = :especializacion
                       WHERE id_persona = :id_persona';
    
            $stmt2 = $this->conn->prepare($query2);
    
            $stmt2->bindParam(':Bodega', $data['Bodega']);
            $stmt2->bindParam(':numeroempleado', $data['numeroempleado']);
            $stmt2->bindParam(':especializacion', $data['especializacion']);
            $stmt2->bindParam(':id_persona', $data['id_persona']);
    
            $result2 = $stmt2->execute();
    
            // Si ambas consultas se ejecutan correctamente, se confirma la transacción
            if ($result1 && $result2) {
                $this->conn->commit();
                return true;
            } else {
                // Si alguna consulta falla, se deshace la transacción
                $this->conn->rollBack();
                return false;
            }
        } catch (Exception $e) {
            // Si ocurre una excepción, se deshace la transacción y se muestra el error
            $this->conn->rollBack();
            throw $e;
        }
    }
    

    public function delete(int $id_persona): bool {
        try {
            // Inicia una transacción
            $this->conn->beginTransaction();
    
            // Primero, elimina de la tabla principal
            $query1 = 'DELETE FROM ' . $this->table . ' WHERE id_persona = :id_persona';
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->bindParam(':id_persona', $id_persona);
            $result1 = $stmt1->execute();
    
            // Luego, elimina de la tabla de empleados
            $query2 = 'DELETE FROM ' . $this->table_empleado . ' WHERE id_persona = :id_persona';
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindParam(':id_persona', $id_persona);
            $result2 = $stmt2->execute();
    
            // Si ambas consultas se ejecutan correctamente, se confirma la transacción
            if ($result1 && $result2) {
                $this->conn->commit();
                return true;
            } else {
                // Si alguna consulta falla, se deshace la transacción
                $this->conn->rollBack();
                return false;
            }
        } catch (Exception $e) {
            // Si ocurre una excepción, se deshace la transacción y se muestra el error
            $this->conn->rollBack();
            throw $e;
        }
    }
    

    public function getProfile(int $id_persona): ?array {
        return $this->getById($id_persona);
    }

    public function getHorasLaboradas(string $bodega): ?array {
        $query = 'SELECT 
                    CONCAT(p.nombre, \' \', p.apellidomaterno, \' \', p.apellidopaterno) AS nombre,
                    e.numeroempleado as id, 
                    e.especializacion,
                    SUM(EXTRACT(EPOCH FROM (s.horafin - s.horainicio))/3600) AS horas_trabajadas
                FROM 
                    ' . $this->table . ' p
                JOIN 
                    ' . $this->table_empleado . ' e ON p.id_persona = e.id_persona
                JOIN 
                    ' . $this->table_servicio . ' s ON e.id_empleado = s.id_empleado
                WHERE 
                    e.especializacion != \'Administrador\' AND e.id_bodega = :bodega
                GROUP BY 
                    p.id_persona, 
                    nombre,
                    e.id_empleado, 
                    e.especializacion';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bodega', $bodega);
        $stmt->execute();
        
    
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $rows ?: null;
    }

    public function getReportesServicio(string $bodega): ?array {
        // Mostrar la consulta y el parámetro para depuración
        echo 'ID Bodega: ' . htmlspecialchars($bodega) . '<br>';
    
        $query = '
            SELECT 
                e.numeroempleado AS numero_trabajador,
                CONCAT(p_trabajador.nombre, \' \', p_trabajador.apellidopaterno, \' \', p_trabajador.apellidomaterno) AS nombre_trabajador,
                CONCAT(p_cliente.nombre, \' \', p_cliente.apellidopaterno, \' \', p_cliente.apellidomaterno) AS nombre_cliente,
                d.direccion,
                s.tiposervicio AS tipo_servicio,
                pt.fechaprogramada AS fecha_servicio,
                s.horainicio AS hora_inicio,
                s.horafin AS hora_fin,
                s.id_servicio,
                i.producto AS materiales_utilizados
            FROM 
                historialservicio hs
            JOIN 
                servicio s ON hs.id_servicio = s.id_servicio
            JOIN 
                empleado e ON hs.id_empleado = e.id_empleado
            JOIN 
                persona p_trabajador ON e.id_persona = p_trabajador.id_persona
            JOIN 
                peticion pt ON hs.id_peticion = pt.id_peticion
            JOIN 
                cliente c ON pt.id_cliente = c.id_cliente
            JOIN 
                persona p_cliente ON c.id_persona = p_cliente.id_persona
            JOIN 
                direccion d ON pt.id_direccion = d.id_direccion
            JOIN 
                suministroservicio ss ON s.id_servicio = ss.id_servicio
            JOIN 
                suministro sm ON ss.id_suministro = sm.id_suministro
            JOIN 
                suministroinventario si ON sm.id_suministro = si.id_suministro
            JOIN 
                inventario i ON si.id_inventario = i.id_inventario
            JOIN 
                bodega b ON e.id_bodega = b.id_bodega
            WHERE 
                b.id_bodega = :bodega
            ORDER BY 
                fecha_servicio, hora_inicio, hora_fin';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bodega', $bodega, PDO::PARAM_INT);
    
        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($rows) {
                return $rows;
            } else {
                echo 'No se encontraron resultados.<br>';
            }
        } else {
            echo 'Error en la ejecución de la consulta.<br>';
        }
        
        return null;
    }
    
    
    

    public function getHistorialServicios(int $id_cliente): ?array {
        $query = 'SELECT p.id_peticion, p.FechaPeticion, p.TipoServicio, p.Descripcion, p.InstruccionesExtra, p.Estado, p.FechaProgramada, p.HoraProgramada,
                         e.Nombre AS PlomeroNombre, e.ApellidoPaterno AS PlomeroApellido, d.Direccion,
                         s.id_servicio, s.Costo, s.Calificacion, s.Estado AS ServicioEstado
                  FROM ' . $this->table_peticion . ' p
                  LEFT JOIN ' . $this->table_servicio . ' s ON p.id_peticion = s.id_peticion
                  LEFT JOIN ' . $this->table_empleado . ' e ON s.id_empleado = e.id_empleado
                  LEFT JOIN Direccion d ON p.id_direccion = d.id_direccion
                  WHERE p.id_cliente = :id_cliente
                  ORDER BY p.FechaPeticion DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrabajadores(int $bodega): ?array {
        $query = 'SELECT e.numeroempleado AS numero_empleado,
                    e.id_bodega,
                CONCAT(p.nombre, \' \', p.apellidomaterno, \' \', p.apellidopaterno) AS nombre,
                e.especializacion FROM ' . $this->table_empleado . ' e 
                  JOIN ' . $this->table . ' p ON e.id_persona = p.id_persona 
                  WHERE e.id_bodega = :id_bodega';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_bodega', $bodega, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function makeSolicitud(array $data): bool {
        try {
            $this->conn->beginTransaction();

            
            // Insertar dirección
            $queryDireccion = 'INSERT INTO Direccion (id_cliente, Direccion) VALUES (:id_cliente, :Direccion)';
            $stmtDireccion = $this->conn->prepare($queryDireccion);
            $stmtDireccion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtDireccion->bindParam(':Direccion', $data['Direccion']);
            $stmtDireccion->execute();
            $id_direccion = $this->conn->lastInsertId();

            // Insertar método de pago
            $queryMetodoPago = 'INSERT INTO ' . $this->table_metodo_pago . ' 
                                (NumeroTarjeta, NombreTitular, FechaExpiracion, CVV) 
                                VALUES (:NumeroTarjeta, :NombreTitular, :FechaExpiracion, :CVV)';
            $stmtMetodoPago = $this->conn->prepare($queryMetodoPago);
            $stmtMetodoPago->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtMetodoPago->bindParam(':NombreTitular', $data['NombreTitular']);
            $stmtMetodoPago->bindParam(':FechaExpiracion', $data['FechaExpiracion']);
            $stmtMetodoPago->bindParam(':CVV', $data['CVV']);
            $stmtMetodoPago->execute();

            // Insertar petición
            $queryPeticion = 'INSERT INTO ' . $this->table_peticion . ' 
                             (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado) 
                             VALUES (:id_cliente, :id_direccion, :TipoServicio, :Descripcion, :InstruccionesExtra, :FechaProgramada, :HoraProgramada, :FechaPeticion, :Estado)';
            $stmtPeticion = $this->conn->prepare($queryPeticion);
            $stmtPeticion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtPeticion->bindParam(':id_direccion', $id_direccion);
            $stmtPeticion->bindParam(':TipoServicio', $data['TipoServicio']);
            $stmtPeticion->bindParam(':Descripcion', $data['Descripcion']);
            $stmtPeticion->bindParam(':InstruccionesExtra', $data['InstruccionesExtra']);
            $stmtPeticion->bindParam(':FechaProgramada', $data['FechaProgramada']);
            $stmtPeticion->bindParam(':HoraProgramada', $data['HoraProgramada']);
            $stmtPeticion->bindParam(':FechaPeticion', $data['FechaPeticion']);
            $stmtPeticion->bindParam(':Estado', $data['Estado']);
            $stmtPeticion->execute();
            $id_peticion = $this->conn->lastInsertId();

            // Insertar relación entre petición y método de pago
            $queryPeticionMetodoPago = 'INSERT INTO ' . $this->table_peticion_metodo_pago . ' 
                                       (id_peticion, NumeroTarjeta, Estado) 
                                       VALUES (:id_peticion, :NumeroTarjeta, :Estado)';
            $stmtPeticionMetodoPago = $this->conn->prepare($queryPeticionMetodoPago);
            $stmtPeticionMetodoPago->bindParam(':id_peticion', $id_peticion);
            $stmtPeticionMetodoPago->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtPeticionMetodoPago->bindParam(':Estado', $data['Estado']);
            $stmtPeticionMetodoPago->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }

    public function cancelSolicitud(int $id_peticion): bool {
        $query = 'DELETE FROM ' . $this->table_peticion . ' WHERE id_peticion = :id_peticion';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peticion', $id_peticion);

        return $stmt->execute();
    }

    public function getFactura(int $id_factura): ?array {
        $query = 'SELECT * FROM Factura WHERE id_factura = :id_factura';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $id_factura);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSuministros(int $bodega): ?array {
        $query = 'SELECT * FROM Inventario WHERE id_bodega = :id_bodega';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_bodega', $bodega);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCostoServicio(int $bodega): ?array {
        $query = 'SELECT 
            CONCAT(p.nombre, \' \', p.apellidopaterno, \' \', p.apellidomaterno) AS cliente,
            pt.fechaprogramada,
            s.tiposervicio,
            s.costo
        FROM 
            historialservicio hs
        JOIN 
            servicio s ON hs.id_servicio = s.id_servicio
        JOIN 
            peticion pt ON hs.id_peticion = pt.id_peticion
        JOIN 
            cliente c ON pt.id_cliente = c.id_cliente
        JOIN 
            persona p ON c.id_persona = p.id_persona
        JOIN 
            empleado e ON hs.id_empleado = e.id_empleado
        JOIN 
            bodega b ON e.id_bodega = b.id_bodega
        WHERE 
            b.id_bodega = :id_bodega';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_bodega', $bodega);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>