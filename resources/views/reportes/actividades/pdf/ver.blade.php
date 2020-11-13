<<?php $hoy = date("Y-m-d"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte <?php print($hoy) ?> {{$rpta1[0]->cUsuario}}</title>
    <style>
      @page{
        margin: 1.3rem;
        margin-top: 1.0rem;
        padding: 1rem;
      }
      body{
        margin: 0px;
      }
      *{
        font-family: verdana, arial, sans-serif;
      }
      .cabecera{
        background-color: #FEFEFE;
        color: #000000;
        padding: 2rem;
        padding-top: .2rem;
        padding-bottom: 0px;
      }
      .cabecera .logo{
        margin: 5px;
      }
      .cabecera table{
        padding: 1px;
        margin-bottom: .2rem;
      }
      table{
        font-size: x-small
      }
      tfoot tr td{
        font-weight: bold;
        font-size: x-small
      }
    </style>
  </head>
  <body>
    <div class="cabecera">
        <table width="100%" cellspacing="0" cellspacing="1" border="1" align="center">
            <tr>
                <td>
                    <table width="100%" cellspacing="0" cellspacing="1" align="center">
                        <tr>
                            <td>
                                <img src="{{$logo}}" alt="Texto alternativo al no cargar la imagen" class="logo" width="150" height="90">
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" cellspacing="0" cellspacing="1" align="center">
                        <tr>
                            <td>Fecha de Reporte</td>
                            <td><?php print($hoy) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" cellspacing="0" cellspacing="1" border="1" align="center">
            <tr align="center" align="middle">
                <td colspan="2">
                    <h3><strong>Información del Usuario</strong></h3>
                </td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td>{{$rpta1[0]->cUsuario}}</td>
            </tr>
            <tr>
                <td>Correo Electronico</td>
                <td>{{$rpta1[0]->cEmail}}</td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellspacing="1" border="1" align="center">
            <thead style="background-color: lightgray;">
                <tr align="center" align="middle">
                    <th colspan="6">Detalle de Actividades</th>
                </tr>
                <tr>
                    <th>Fecha de Actividad</th>
                    <th>Actividad</th>
                    <th>Función</th>
                    <th>Hora de inicio</th>
                    <th>Tiempo transcurrido</th>
                    <th>Tiempo de fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rpta2 as $key => $value) {  ?>
                <tr>
                    <td align="center"><span>{{$value->dFechaIni}}</span></td>
                    <td align="center"><span>{{$value->cActividad}}</span></td>
                    <td align="center"><span>{{$value->cFuncionCode}}</span></td>
                    <td align="center"><span>{{$value->tTiempoIni}}</span></td>
                    <td align="center"><span>{{$value->tTiempoTrans}}</span></td>
                    <td align="center"><span>{{$value->tTiempoFin}}</span></td>
                </tr>
              <?php  } ?>
            </tbody>
        </table>

    </div>
  </body>
</html>
