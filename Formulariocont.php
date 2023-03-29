<?php require_once('Connections/web.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO datos (Cedula, Nombre, Fechadenacimiento, Paisdenacimiento, Sexo, Telefono, Correo, Comentario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Cedula'], "text"),
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Fechadenacimiento'], "text"),
                       GetSQLValueString($_POST['Paisdenacimiento'], "text"),
                       GetSQLValueString($_POST['Sexo'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"),
                       GetSQLValueString($_POST['Correo'], "text"),
                       GetSQLValueString($_POST['Comentario'], "text"));

  mysql_select_db($database_web, $web);
  $Result1 = mysql_query($insertSQL, $web) or die(mysql_error());

  $insertGoTo = "inicio.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body bgcolor="#FFCC99">
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="1102" border="1" align="center">
    <tr>
      <td><div align="center">
        <h1>FORMULARIO</h1>
      </div></td>
    </tr>
    <tr>
      <td height="42"><label for="Cedula">CEDULA</label>
      <input type="text" name="Cedula" id="Cedula" /></td>
    </tr>
    <tr>
      <td height="49"><label for="Nombre">NOMBRE</label>
      <input type="text" name="Nombre" id="Nombre" /></td>
    </tr>
     <tr>
    <td height="45">
      <label for="Fechadenacimiento">FECHA DE NACIMIENTO:</label>
      <input type="date" name="Fechadenacimiento" id="Fechadenacimiento" />
    </td>
  </tr>
    <tr>
    <td height="49">
      <label for="Paisdenacimiento">PAIS DE NACIMIENTO:</label>
      <select name="Paisdenacimiento" id="Paisdenacimiento">
        <option>ECUADOR</option>
        <option>COLOMBIA</option>
        <option>VENEZUELA</option>
        <option>CHILE</option>
        <option>PERU</option>
        <option>MEXICO</option>
        <option>ESTADOS UNIDOS</option>
      </select>
    </td>
  </tr>
    <tr>
    <td height="65"><fieldset>
      <legend>SEXO:</legend>
        <input type="radio" name="Sexo" id="Sexo" value="FEMENINO" />
        <label for="radio">FEMENINO</label>
        <input type="radio" name="Sexo" id="Sexo" value="MASCULINO" />
        <label for="radio">MASCULINO</label>
</fieldset></td>
  </tr>
    <tr>
      <td height="49"><label for="Telefono">TELEFONO</label>
      <input type="text" name="Telefono" id="Telefono" /></td>
    </tr>
    <tr>
    <td height="57">
      <label for="Correo" id="Correo">CORREO ELECTRONICO:</label>
      <input type="email" name="Correo" id="Correo" />
    </td>
  </tr>
    <tr>
      <td height="81">
        <label for="Comentario" id="Comentario">COMENTARIOS:</label>
        <textarea id="msg" name="Comentario"> </textarea>
        
        <input type="submit" value="ENVIAR" id="ENVIAR" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>