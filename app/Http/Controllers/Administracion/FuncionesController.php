<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FuncionesController extends Controller
{
    public function getListarFunciones(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdFunciones = $request->nIdFunciones;
      $cNombre = $request->cNombre;
      $cFuncion_Code = $request->cFuncion_Code;

      $nIdFunciones = ($nIdFunciones == NULL) ? ($nIdFunciones = 0) : $nIdFunciones;
      $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
      $cFuncion_Code = ($cFuncion_Code == NULL) ? ($cFuncion_Code = '') : $cFuncion_Code;

      $rpta = DB::select('call sp_Usuario_getListarFunciones(?, ?, ?)', [
        $nIdFunciones,
        $cNombre,
        $cFuncion_Code
      ]);
      return $rpta;
    }
    public function setRegistrarFunciones(Request $request){
      if(!$request->ajax()) return redirect('/');

      $cNombre = $request->cNombre;
      $cFuncion_Code = $request->cFuncion_Code;
      $nIdAuthUser = Auth::id();

      $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
      $cFuncion_Code = ($cFuncion_Code == NULL) ? ($cFuncion_Code = '') : $cFuncion_Code;

      $rpta = DB::select('call sp_Usuario_setRegistrarFunciones(?, ?, ?)', [
        $cNombre,
        $cFuncion_Code,
        $nIdAuthUser
      ]);
      return $rpta;
    }
    public function setEditarFunciones(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdFunciones = $request->nIdFunciones;
      $cNombre = $request->cNombre;
      $cFuncion_Code = $request->cFuncion_Code;
      $nIdAuthUser = Auth::id();

      $nIdFunciones = ($nIdFunciones == NULL) ? ($nIdFunciones = 0) : $nIdFunciones;
      $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
      $cFuncion_Code = ($cFuncion_Code == NULL) ? ($cFuncion_Code = '') : $cFuncion_Code;

      $rpta = DB::select('call sp_Usuario_setEditarFunciones(?, ?, ?, ?)', [
        $nIdFunciones,
        $cNombre,
        $cFuncion_Code,
        $nIdAuthUser
      ]);
      return $rpta;
    }



}
