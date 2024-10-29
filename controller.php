<?php
function VerificarUsuario($username, $passMd5)
{
    include("db.php");
    $sql = "SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1 ";
    $sql .= " and `usuario`='" . $username . "'";
    $sql .= " and `password`='" . $passMd5 . "'";

    $query=$mysqli -> query($sql);
    if($query-> num_rows >0){
        $fila=$query->fetch_assoc();
        return $fila;
    }
    else{
        return 0;
    }
}

function VerificarUsuario2($tabla, $column1, $valor1, $column2, $valor2)
{
    include("db.php");
    $sql = "SELECT * FROM `" .$tabla. "` WHERE 1 ";
    $sql .= " and `".$column1. "`='" . $valor1 . "'";
    $sql .= " and `".$column2. "`='" . $passMd5 . "'";

    $query=$mysqli -> query($sql);
    if($query-> num_rows >0){
        $fila=$query->fetch_assoc();
        return $fila;
    }
    else{
        return 0;
    }
}
function getById($tabla, $id)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT * FROM `" . $tabla . "` WHERE `id`=" . $id;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila;
}

//! LO DE ABAJO ES DEL ANTERIOR EJERCICIO
function getAll($tabla)
{
    include("db.php");
    $sql = "SELECT * FROM `" . $tabla . "` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}

function getAllV($tabla)
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT * FROM `" . $tabla . "` WHERE 1";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}





function delById($tabla, $id)
{
    include("db.php");
    $sql = "DELETE FROM `" . $tabla . "` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}


function save($tabla, $campos, $valores)
{

    include("db.php");
    $sql = "INSERT INTO `" . $tabla . "`(" . $campos . ") VALUES (";
    $sql .= $valores;
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}


function saveV($tabla, $datos)
{

    include("db.php");
    $sql = "INSERT INTO `" . $tabla . "`(";

    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "`" . $k . "`";
            $aux++;
        } else {
            $sql .= ",`" . $k . "`";
        }
    }
    $sql .= ")";
    $sql .= "VALUES (";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "'" . $v . "'";
            $aux++;
        } else {
            $sql .= ",'" . $v . "'";
        }
    }
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}


function saveV2($tabla, $datos)
{

    include("db.php");

    $campos = "";
    $valores = "";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $campos .= "`" . $k . "`";
            $valores .= "'" . $v . "'";
            $aux++;
        } else {
            $campos .= ",`" . $k . "`";
            $valores .= ",`" . $v . "`";
        }
    }

    $sql = "INSERT INTO `" . $tabla . "`(";
    $sql .= $campos;
    $sql .= ")";
    $sql .= "VALUES (";
    $sql .= $valores;
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}


function savePDO($tabla, $datos)
{

    include("db.php");
    $campos = "";
    $valoresIn = "";
    $aux = 0;
    $in = array();
    foreach ($datos as $k => $v) {
        array_push($in, $v);
        if ($aux == 0) {
            $campos .= $k;
            $valoresIn .= "?";
            $aux++;
        } else {
            $campos .= "," . $k;
            $valoresIn .= ",?";
        }
    }
    $stmt = $dbh->prepare("INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valoresIn . ")");

    $stmt->execute($in);
    echo 1;
}


function updateById($tabla, $datos, $id)
{
    include("db.php");
    $sql = "UPDATE `" . $tabla . "` SET  ";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "`" . $k . "`='" . $v . "'";
            $aux++;
        } else {
            $sql .= ",`" . $k . "`='" . $v . "'";
        }
    }
    $sql .= " WHERE `id`='" . $id . "'";

    if ($mysqli->query($sql)) return 1;
    else return 0;
}


function TodosClientes()
{
    include("db.php");
    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}


function TodosClientesV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}

function EliminarCliente($id)
{
    include("db.php");
    $sql = "DELETE FROM `clientes` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function InsertarCliente($post)
{
    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];
    include("db.php");
    $sql = "INSERT INTO `clientes`(`id`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $nombre . "'";
    $sql .= ",'" . $apellidos . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

function ActualizarCliente($post)
{
    $id = $post["id"];
    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];

    include("db.php");
    $sql = "UPDATE `clientes` SET `nombre`='" . $nombre . "',`apellidos`='" . $apellidos . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}



function TodosProveedores()
{
    include("db.php");
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}


function TodosProveedoresV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}

function EliminarProveedor($id)
{
    include("db.php");
    $sql = "DELETE FROM `proveedores` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function InsertarProveedor($post)
{
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];
    include("db.php");
    $sql = "INSERT INTO `proveedores`(`id`, `razon_social`, `nombre_comercial`,`cif`,`formapago`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $razon_social . "'";
    $sql .= ",'" . $nombre_comercial . "'";
    $sql .= ",'" . $cif . "'";
    $sql .= ",'" . $formapago . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";
    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

function ActualizarProveedor($post)
{
    $id = $post["id"];
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];

    include("db.php");
    $sql = "UPDATE `proveedores` SET `razon_social`='" . $razon_social . "',`nombre_comercial`='" . $nombre_comercial . "',`cif`='" . $cif . "',`formapago`='" . $formapago . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";



    if ($mysqli->query($sql)) return 1;
    else return 0;
}
function DatosProveedor($id)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE `id`=" . $_GET["id"];
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila;
}

function SelectProveedores()
{
    include("db.php");
    $options = "";
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila["razon_social"] . '-' . $fila["cif"] . '</option>';
        }
    }
    return $options;
}


function SelectProvincias()
{
    include("db.php");
    $sqlProvincias = "SELECT `id`, `provincia`, `created_at`, `updated_at` FROM `provincias` WHERE 1 ORDER BY provincia asc";
    $resultProv = $mysqli->query($sqlProvincias);
    if ($resultProv->num_rows > 0) {
        while ($filaProv = $resultProv->fetch_assoc()) {
?>
            <option value="<?php echo $filaProv["id"]; ?>"><?php echo $filaProv["provincia"]; ?></option>
<?php
        }
    }
}


function SelectOptionsId($tabla, $mostrar)
{
    include("db.php");
    $sql = "SELECT `id`, `" . $mostrar . "` FROM `" . $tabla . "`";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

function SelectOptions($tabla, $value, $mostrar)
{
    include("db.php");
    $sql = "SELECT `" . $value . "`, `" . $mostrar . "` FROM `" . $tabla . "`";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

function SelectOptionsIdOrderBy($tabla, $mostrar, $order)
{
    include("db.php");
    $sql = "SELECT `id`, `" . $mostrar . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

function SelectOptionsOrderBy($tabla, $value, $mostrar, $order)
{
    include("db.php");
    $sql = "SELECT `" . $value . "`, `" . $mostrar . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

function SelectOptions2CamposOrderBy($tabla, $value, $mostrar1, $mostrar2, $separador, $order)
{
    include("db.php");
    $sql = "SELECT `" . $value . "`, `" . $mostrar1 . "`, `" . $mostrar2 . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar1 . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar1] . $separador . $fila[$mostrar2] . '</option>';
        }
    }
    return $options;
}


function SelectOptionsVariosCamposOrderBy($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");

    $Vmostrar = explode(",", $Vmostrar);
    $sql = "SELECT `" . $value . "` ";
    foreach ($Vmostrar as $mostrar) {
        $sql .= ", `" . $mostrar . "`";
    }
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}

function SelectOptionsVariosCamposOrderBy2($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");


    $sql = "SELECT `" . $value . "` ";
    $sql .= ", `" . $Vmostrar . "`";
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';

            $Vmostrar = explode(",", $Vmostrar);
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}

function SelectOptionsVariosCamposOrderByArray($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");

    $sql = "SELECT `" . $value . "` ";
    foreach ($Vmostrar as $mostrar) {
        $sql .= ", `" . $mostrar . "`";
    }
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}





function SelectOptionsIdSel($tabla, $mostrar, $sel)
{
    include("db.php");
    // $sql="SELECT `id`, `".$mostrar."` FROM `".$tabla."`";
    $query = getAll($tabla);
    //$query=$mysqli->query($sql);    
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            $selected = "";
            if ($fila["id"] == $sel) {
                $selected = "selected";
            }

            $options .= '<option value="' . $fila["id"] . '"   ' . $selected . '   >' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

function SelectOpciones($opciones)
{
    $options = "";
    $Vopciones = explode(";", $opciones);
    foreach ($Vopciones as $op) {
        $options .= '<option value="' . $op . '">' . $op . '</option>';
    }

    return $options;
}

function SelectOpcionesSel($opciones, $sel)
{
    $options = "";
    $Vopciones = explode(";", $opciones);
    foreach ($Vopciones as $op) {
        $selected = "";
        if ($op == $sel) {
            $selected = "selected";
        }
        $options .= '<option value="' . $op . '"    ' . $selected . '     >' . $op . '</option>';
    }

    return $options;
}

function UploadFile($file, $carpeta, $nombre)
{


    if ($file["name"] != "") {
        //directorio de subida
        $target_dir = $carpeta . "/";
        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . $nombre . "." . $imageTypeFile;

        //borro si existe
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "error";
        }
    } else {
        return "error";
    }
}

function uploadfile2($imagen, $target_dir, $nombre)
{

    if ($imagen["name"] != "") {
        //directorio de subida

        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . "/" . $nombre . "." . $imageTypeFile;
        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "";
        }
    } else {
        return "";
    }
}

function UploadFile3($file, $target_file, $nombre)
{
    if ($file["name"] != "") {
        $archivo = $target_file . "/" . $nombre;
        if (file_exists($archivo)) {
            unlink($archivo);
        }



        //directorio de subida
        $target_dir = $target_file . "/";
        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . $nombre . "." . $imageTypeFile;
        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "";
        }
    } else return "";
}

function conseguirValor($tabla, $campo, $id)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT `" . $campo . "` FROM `" . $tabla . "` WHERE `id`=" . $id;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila[$campo];
}

function borrarArchivo($target)
{

    if (file_exists($target)) {
        unlink($target);
        return 1;
    } else return 0;
}






?>