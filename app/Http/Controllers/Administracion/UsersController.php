<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function getListarUsuarios(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;
      $cNombre = $request->cNombre;
      $cUsuario = $request->cUsuario;
      $cUserCode = $request->cUserCode;
      $cCorreo = $request->cCorreo;
      $cEstado = $request->cEstado;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
      $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
      $cUserCode = ($cUserCode == NULL) ? ($cUserCode = '') : $cUserCode;
      $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
      $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
      $cEstado = ($cEstado == NULL) ? ($cEstado = '') : $cEstado;

      $rpta = DB::select('call sp_Usuario_getListarUsuarios(?, ?, ?, ?, ?, ?)', [
        $nIdUsuario,
        $cNombre,
        $cUserCode,
        $cUsuario,
        $cCorreo,
        $cEstado
      ]);
      return $rpta;
    }

    public function setRegistrarUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');
      $cPrimerNombre = $request->cPrimerNombre;
      $cSegundoNombre = $request->cSegundoNombre;
      $cApellido = $request->cApellido;
      $cUserCode = $request->cUserCode;
      $cUsuario = $request->cUsuario;
      $cCorreo = $request->cCorreo;
      $cContraseña = Hash::make($request->cContraseña);
      $oFotografia = $request->oFotografia;
      $nIdAuthUser = Auth::id();

      $cPrimerNombre = ($cPrimerNombre == NULL) ? ($cPrimerNombre = '') : $cPrimerNombre;
      $cSegundoNombre = ($cSegundoNombre == NULL) ? ($cSegundoNombre = '') : $cSegundoNombre;
      $cApellido = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
      $cUserCode = ($cUserCode == NULL) ? ($cUserCode = '') : $cUserCode;
      $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
      $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
      $cContraseña = ($cContraseña == NULL) ? ($cContraseña = '') : $cContraseña;
      $oFotografia = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

      $rpta = DB::select('call sp_Usuario_setRegistrarUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $cPrimerNombre,
        $cSegundoNombre,
        $cApellido,
        $cUserCode,
        $cUsuario,
        $cCorreo,
        $cContraseña,
        $oFotografia,
        $nIdAuthUser
      ]);
      return $rpta[0]->nIdUsuario;
    }

    public function setEditarUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');
      $nIdUsuario = $request->nIdUsuario;
      $cPrimerNombre = $request->cPrimerNombre;
      $cSegundoNombre = $request->cSegundoNombre;
      $cApellido = $request->cApellido;
      $cUserCode = $request->cUserCode;
      $cUsuario = $request->cUsuario;
      $cCorreo = $request->cCorreo;
      $cContraseña = $request->cContraseña;
      if($cContraseña != null){
        $cContraseña = Hash::make($request->cContraseña);
      }
      $oFotografia = $request->oFotografia;
      $nIdAuthUser = Auth::id();

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
      $cPrimerNombre = ($cPrimerNombre == NULL) ? ($cPrimerNombre = '') : $cPrimerNombre;
      $cSegundoNombre = ($cSegundoNombre == NULL) ? ($cSegundoNombre = '') : $cSegundoNombre;
      $cApellido = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
      $cUserCode = ($cUserCode == NULL) ? ($cUserCode = '') : $cUserCode;
      $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
      $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
      $cContraseña = ($cContraseña == NULL) ? ($cContraseña = '') : $cContraseña;
      $oFotografia = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

      DB::select('call sp_Usuario_setEditarUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $nIdUsuario,
        $cPrimerNombre,
        $cSegundoNombre,
        $cApellido,
        $cUserCode,
        $cUsuario,
        $cCorreo,
        $cContraseña,
        $oFotografia,
        $nIdAuthUser
      ]);
    }

    public function setCambiarEstadoUser(Request $request){
      if(!$request->ajax()) return redirect('/');
      $nIdUsuario = $request->nIdUsuario;
      $cEstado = $request->cEstado;
      $nIdAuthUser = Auth::id();

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
      $cEstado = ($cEstado == NULL) ? ($cEstado = 0) : $cEstado;

      DB::select('call sp_Usuario_setCambiarEstadoUser(?, ?, ?)', [
        $nIdUsuario,
        $cEstado,
        $nIdAuthUser
      ]);
    }

    public function setEditarRolByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');
      $nIdUsuario = $request->nIdUsuario;
      $nIdRol = $request->nIdRol;


      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
      $nIdRol = ($nIdRol == NULL) ? ($nIdRol = '') : $nIdRol;


      DB::select('call sp_Usuario_setEditarRolByUsuario(?, ?)', [
        $nIdUsuario,
        $nIdRol
      ]);
    }

    public function getRolByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getRolByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function getListarPermisosByRolAsignado(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarPermisosByRolAsignado(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function getListarPermisosByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarPermisosByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function setRegistrarPermisosByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;


      try {

        DB::beginTransaction();

        DB::select('call sp_Usuario_setEliminarPermisosByUsuario(?)', [
          $nIdUsuario
        ]);

        $listPermisos = $request->listPermisosFilter;
        $listPermisosSize = sizeof($listPermisos);

        if($listPermisosSize > 0){
          foreach ($listPermisos  as $key => $value) {
            if($value['checked'] == true){
              DB::select('call sp_Usuario_setRegistrarPermisosByUsuario(?, ?)', [
                $nIdUsuario,
                $value['id']
              ]);
            }
          }
        }

        DB::commit();

      } catch (Exception $e) {

        DB::rollback();

      }
    }

    public function getListarRolPermisosByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;
      if(!$nIdUsuario){
        $nIdUsuario = Auth::id();
      }

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarRolPermisosByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }
/* --------------------------------------------------------------*/
    public function getListarFuncionesByUsuarioAsignado(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarFuncionesByUsuarioAsignado(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function setRegistrarFuncionesByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;


      try {

        DB::beginTransaction();

        DB::select('call sp_Usuario_setEliminarFuncionesByUsuario(?)', [
          $nIdUsuario
        ]);

        $listfunciones = $request->listFuncionesFilter;
        $listfuncionesSize = sizeof($listfunciones);

        if($listfuncionesSize > 0){
          foreach ($listfunciones  as $key => $value) {
            if($value['checked'] == true){
              DB::select('call sp_Usuario_setRegistrarFuncionesByUsuario(?, ?)', [
                $nIdUsuario,
                $value['id']
              ]);
            }
          }
        }

        DB::commit();

      } catch (Exception $e) {

        DB::rollback();

      }
    }

    public function getListarUserFuncionesByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;
      if(!$nIdUsuario){
        $nIdUsuario = Auth::id();
      }

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarUserFuncionesByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function getNombreByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getNombreByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

    public function getListarFuncionesByUsuario(Request $request){
      if(!$request->ajax()) return redirect('/');

      $nIdUsuario = $request->nIdUsuario;

      $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;


      $rpta = DB::select('call sp_Usuario_getListarFuncionesByUsuario(?)', [
                $nIdUsuario
              ]);
      return $rpta;
    }

}
