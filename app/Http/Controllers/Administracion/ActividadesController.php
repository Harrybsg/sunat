<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ActividadesController extends Controller
{
  public function getListarFuncionesUsuario(Request $request){
    if(!$request->ajax()) return redirect('/');

    $nIdUsuario = $request->nIdUsuario;

    $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;


    $rpta = DB::select('call sp_Usuario_getListarFuncionesUsuario(?)', [
              $nIdUsuario
            ]);
    return $rpta;
  }

  public function setRegistrarActividad(Request $request){
    if(!$request->ajax()) return redirect('/');

    $cActivity = $request->cActivity;
    $nIdFuncion = $request->nIdFuncion;
    $nIdUsuario = $request->nIdUsuario;
    $dFechaIni = $request->dFechaIni;
    $tHoraIni = $request->tHoraIni;
    $tTiempoTranscurrido = $request->tTiempoTranscurrido;
    $tTerActi = $request->tTerActi;

    $cActivity = ($cActivity == NULL) ? ($cActivity = '') : $cActivity;
    $nIdFuncion = ($nIdFuncion == NULL) ? ($nIdFuncion = '') : $nIdFuncion;
    $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
    $dFechaIni = ($dFechaIni == NULL) ? ($dFechaIni = '') : $dFechaIni;
    $tHoraIni = ($tHoraIni == NULL) ? ($tHoraIni = '') : $tHoraIni;
    $tTiempoTranscurrido = ($tTiempoTranscurrido == NULL) ? ($tTiempoTranscurrido = '') : $tTiempoTranscurrido;
    $tTerActi = ($tTerActi == NULL) ? ($tTerActi = '') : $tTerActi;

    DB::select('call sp_Usuario_setRegistrarActividad(?, ?, ?, ?, ?, ?, ?)', [
      $cActivity,
      $nIdFuncion,
      $nIdUsuario,
      $dFechaIni,
      $tHoraIni,
      $tTiempoTranscurrido,
      $tTerActi
    ]);
  }

  public function getListarActividades(Request $request){
    if(!$request->ajax()) return redirect('/');

    $nIdUsuario = $request->nIdUsuario;

    $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;


    $rpta = DB::select('call sp_Usuario_getListarActividades(?)', [
              $nIdUsuario
            ]);
    return $rpta;
  }

}
