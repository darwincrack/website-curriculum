<?php

	session_start();

	require_once "../model/Usuario.php";

	$objusuario = new usuario();

	switch ($_GET["op"]) {

		case 'SaveOrUpdate':	
			$alm = 0;	
			$comp = 0;	
			$vent = 0;	
			$mant = 0;	
			$seg = 0;	
			$cons_comp = 0;		
			$cons_vent = 0;		
			$admin = 0;		

			$idsucursal = $_POST["cboSucursal"];
			$idempleado = $_POST["txtIdEmpleado"];
			$tipo_usuario = $_POST["cboTipoUsuario"];
			//$mnu_almacen = $_POST["chkMnuAlmacen"];
			if(isset($_POST["chkMnuAlmacen"])){
				$alm = true;
			} else {
				$alm = 0;
			}
			
			if(isset($_POST["chkMnuCompras"])){
				$comp = true;
			} else {
				$comp = 0;
			}
			
			if(isset($_POST["chkMnuVentas"])){
				$vent = true;
			} else {
				$vent = 0;
			}
			if(isset($_POST["chkMnuMantenimiento"])){
				$mant = true;
			} else {
				$mant = 0;
			}
			
			if(isset($_POST["chkMnuSeguridad"])){
				$seg = true;
			} else {
				$seg = 0;
			}
			if(isset($_POST["chkMnuConsultaCompras"])){
				$cons_comp = true;
			} else {
				$cons_comp = 0;
			}
			if(isset($_POST["chkMnuConsultaVentas"])){
				$cons_vent = true;
			} else {
				$cons_vent = 0;
			}

			if(isset($_POST["chkMnuAdmin"])){
				$admin = true;
			} else {
				$admin = 0;
			}

				if(empty($_POST["txtIdUsuario"])){
					
					if($objusuario->Registrar($idsucursal, $idempleado, $tipo_usuario, $alm, $comp, $vent, $mant, $seg, $cons_comp, 
						$cons_vent, $admin)){
						echo "Registrado Exitosamente";
					}else{
						echo "Usuario no ha podido ser registado.";
					}
				}else{
					
					$idusuario = $_POST["txtIdUsuario"];
					if($objusuario->Modificar($idusuario, $idsucursal, $idempleado, $tipo_usuario, $alm, $comp, $vent, $mant, $seg, $cons_comp, 
						$cons_vent, $admin)){
						echo "Informacion del Usuario ha sido actualizada";
					}else{
						echo "Informacion del usuario no ha podido ser actualizada.";
					}
				}

			break;

		case "delete":			
			
			$id = $_POST["id"];
			$result = $objusuario->Eliminar($id);
			if ($result) {
				echo "Eliminado Exitosamente";
			} else {
				echo "No fue Eliminado";
			}
			break;
		
		case "list":
			$query_Tipo = $objusuario->Listar();

            $i = 1;
     		while ($reg = $query_Tipo->fetch_object()) {
     			$data[] = array($i,
                    $reg->razon_social,
                    $reg->empleado,
                    $reg->tipo_usuario,
                    $reg->fecha_registro,
                    '<button class="btn btn-warning" data-toggle="tooltip" title="Editar" onclick="cargarDataUsuario('.$reg->idusuario.',\''.$reg->idsucursal.'\',\''.$reg->idempleado.'\',\''.$reg->empleado.'\',\''.$reg->tipo_usuario.'\',\''.$reg->mnu_almacen.'\',\''.$reg->mnu_compras.'\',\''.$reg->mnu_ventas.'\',\''.$reg->mnu_mantenimiento.'\',\''.$reg->mnu_seguridad.'\',\''.$reg->mnu_consulta_compras.'\',\''.$reg->mnu_consulta_ventas.'\',\''.$reg->mnu_admin.'\')"><i class="fa fa-pencil"></i> </button>&nbsp;'.
                    '<button class="btn btn-danger" data-toggle="tooltip" title="Eliminar" onclick="eliminarUsuario('.$reg->idusuario.')"><i class="fa fa-trash"></i> </button>');
                $i++;
            }
            echo json_encode($data);

			break;

		case "listSucursal":
	        require_once "../model/Categoria.php";

	        $objCategoria = new Categoria();

	        $query = $objCategoria->ListarSucursal();

	        while ($reg = $query->fetch_object()) {
	            echo '<option value=' . $reg->idsucursal . '>' . $reg->razon_social . '</option>';
	        }

	        break;

	    case "listEmpleado":

	    	require_once "../model/Categoria.php";

	        $objCategoria = new Categoria();

	        $query_Categoria = $objCategoria->ListarEmpleado();

	        $i = 1;

	        while ($reg = $query_Categoria->fetch_object()) {
	            echo '<tr>
		                
		                <td><input type="radio" name="optEmpleadosBusqueda" data-nombre="'.$reg->nombre.'" data-apellidos="'.$reg->apellidos.'" id="'.$reg->idempleado.'" value="'.$reg->idempleado.'" /></td>
		                <td>'.$i.'</td>
		                <td>'.$reg->apellidos.'</td>
		                <td>'.$reg->nombre.'</td>
		                <td>'.$reg->tipo_documento.'</td>
		                <td>'.$reg->num_documento.'</td>
		                <td>'.$reg->email.'</td>
		                <td><img width=100px height=100px src="./'.$reg->foto.'" /></td>		                
	                   </tr>';
	        }

	        break;

	    case "IngresarSistema":

	    	$user = $_REQUEST["user"];
			$pass = $_REQUEST["pass"];
			
			$query = $objusuario->Ingresar_Sistema($user, md5($pass));
			$fetch = $query->fetch_object();
			
			echo json_encode($fetch);
			
			
			if(isset($fetch)){
				$_SESSION["idusuario"] = $fetch->idusuario;
				$_SESSION["idempleado"] = $fetch->idusuario;
				$_SESSION["empleado"] = $fetch->nom;
				$_SESSION["tipo_documento"] = "CEDULA";
				$_SESSION["tipo_usuario"] = $fetch->cargo;
				$_SESSION["num_documento"] = $fetch->idusuario;
				$_SESSION["direccion"] = $fetch->dir;
				$_SESSION["telefono"] = $fetch->tel;
				$_SESSION["foto"] = "Files/Empleado/user.jpg";
				//$_SESSION["logo"] = $fetch->logo;
				$_SESSION["email"] = 1;
				$_SESSION["login"] = $fetch->usu;
				$_SESSION["razon_social"] = $fetch->sucursal;
				$_SESSION["mnu_almacen"] = 1;
				$_SESSION["mnu_compras"] = 1;
				$_SESSION["mnu_ventas"] = 1;
				$_SESSION["mnu_mantenimiento"] = 1;
				$_SESSION["mnu_seguridad"] = 1;
				$_SESSION["mnu_consulta_compras"] = 1;
				$_SESSION["mnu_consulta_ventas"] = 1;
				$_SESSION["mnu_admin"] = 1;
				$_SESSION["superadmin"] = $fetch->tipo;
			}
			break;

		case "IngresarPanel" :
				$_SESSION["idusuario"] = $_POST["idusuario"];
				$_SESSION["idsucursal"] = $_POST["idsucursal"];
				$_SESSION["idempleado"] = $_POST["idempleado"];
				$_SESSION["superadmin"] = "A";
				$_SESSION["empleado"] = $_POST["empleado"];
				$_SESSION["tipo_documento"] = $_POST["tipo_documento"];
				$_SESSION["tipo_usuario"] = $_POST["tipo_usuario"];
				$_SESSION["num_documento"] = $_POST["num_documento"];
				$_SESSION["direccion"] = $_POST["direccion"];
				$_SESSION["telefono"] = $_POST["telefono"];
				$_SESSION["foto"] = $_POST["foto"];
				$_SESSION["logo"] = $_POST["logo"];
				$_SESSION["email"] = $_POST["email"];
				$_SESSION["login"] = $_POST["login"];
				$_SESSION["sucursal"] = $_POST["razon_social"];
				$_SESSION["mnu_almacen"] = $_POST["mnu_almacen"];
				$_SESSION["mnu_compras"] = $_POST["mnu_compras"];
				$_SESSION["mnu_ventas"] = $_POST["mnu_ventas"];
				$_SESSION["mnu_mantenimiento"] = $_POST["mnu_mantenimiento"];
				$_SESSION["mnu_seguridad"] = $_POST["mnu_seguridad"];
				$_SESSION["mnu_consulta_compras"] = $_POST["mnu_consulta_compras"];
				$_SESSION["mnu_consulta_ventas"] = $_POST["mnu_consulta_ventas"];
				$_SESSION["mnu_admin"] = $_POST["mnu_admin"];
		break;

		case "IngresarPanelSuperAdmin" :
				$_SESSION["idusuario"] = $_POST["idusuario"];
				$_SESSION["idsucursal"] = $_POST["idsucursal"];
				$_SESSION["idempleado"] = $_POST["idempleado"];
				$_SESSION["superadmin"] = $_POST["estadoAdmin"];
				$_SESSION["empleado"] = $_POST["empleado"];
				$_SESSION["tipo_documento"] = $_POST["tipo_documento"];
				$_SESSION["tipo_usuario"] = $_POST["tipo_usuario"];
				$_SESSION["num_documento"] = $_POST["num_documento"];
				$_SESSION["direccion"] = $_POST["direccion"];
				$_SESSION["telefono"] = $_POST["telefono"];
				$_SESSION["foto"] = $_POST["foto"];
				$_SESSION["logo"] = $_POST["logo"];
				$_SESSION["email"] = $_POST["email"];
				$_SESSION["login"] = $_POST["login"];
				$_SESSION["sucursal"] = $_POST["razon_social"];
				$_SESSION["mnu_almacen"] = $_POST["mnu_almacen"];
				$_SESSION["mnu_compras"] = $_POST["mnu_compras"];
				$_SESSION["mnu_ventas"] = $_POST["mnu_ventas"];
				$_SESSION["mnu_mantenimiento"] = $_POST["mnu_mantenimiento"];
				$_SESSION["mnu_seguridad"] = $_POST["mnu_seguridad"];
				$_SESSION["mnu_consulta_compras"] = $_POST["mnu_consulta_compras"];
				$_SESSION["mnu_consulta_ventas"] = $_POST["mnu_consulta_ventas"];
				$_SESSION["mnu_admin"] = $_POST["mnu_admin"];
		break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../index.html");
			break;


	}
	