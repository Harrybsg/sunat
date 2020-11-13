<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/authenticate/login', 'Auth\LoginController@login');

Route::group(['middleware' => ['web']], function () {
  Route::post('/authenticate/logout', 'Auth\LoginController@logout');
  Route::get('/authenticate/getRefrescarUsuarioAutenticado', function(){
    return Auth::user()->load('file');
  });

  Route::get('/administracion/usuario/getListarRolPermisosByUsuario', 'Administracion\UsersController@getListarRolPermisosByUsuario');
  Route::get('/administracion/usuario/getListarUsuarios', 'Administracion\UsersController@getListarUsuarios');
  Route::post('/administracion/usuario/setRegistrarUsuario', 'Administracion\UsersController@setRegistrarUsuario');
  Route::post('/administracion/usuario/setEditarUsuario', 'Administracion\UsersController@setEditarUsuario');
  Route::post('/administracion/usuario/setCambiarEstadoUser', 'Administracion\UsersController@setCambiarEstadoUser');
  Route::post('/administracion/usuario/setEditarRolByUsuario', 'Administracion\UsersController@setEditarRolByUsuario');
  Route::get('/administracion/usuario/getRolByUsuario', 'Administracion\UsersController@getRolByUsuario');
  Route::get('/administracion/usuario/getListarPermisosByRolAsignado', 'Administracion\UsersController@getListarPermisosByRolAsignado');
  Route::get('/administracion/usuario/getListarPermisosByUsuario', 'Administracion\UsersController@getListarPermisosByUsuario');
  Route::post('/administracion/usuario/setRegistrarPermisosByUsuario', 'Administracion\UsersController@setRegistrarPermisosByUsuario');
  Route::get('/administracion/usuario/getNombreByUsuario', 'Administracion\UsersController@getNombreByUsuario');
  Route::post('/administracion/usuario/setRegistrarFuncionesByUsuario', 'Administracion\UsersController@setRegistrarFuncionesByUsuario');
  Route::get('/administracion/usuario/getListarUserFuncionesByUsuario', 'Administracion\UsersController@getListarUserFuncionesByUsuario');
  Route::get('/administracion/usuario/getListarFuncionesByUsuarioAsignado', 'Administracion\UsersController@getListarFuncionesByUsuarioAsignado');
  Route::get('/administracion/usuario/getListarFuncionesByUsuario', 'Administracion\UsersController@getListarFuncionesByUsuario');

  Route::get('/administracion/rol/getListarRoles', 'Administracion\RolesController@getListarRoles');
  Route::get('/administracion/rol/getListarPermisosByRol', 'Administracion\RolesController@getListarPermisosByRol');
  Route::post('/administracion/rol/setRegistrarRolPermisos', 'Administracion\RolesController@setRegistrarRolPermisos');
  Route::post('/administracion/rol/setEditarRolPermisos', 'Administracion\RolesController@setEditarRolPermisos');

  Route::get('/administracion/permiso/getListarPermisos', 'Administracion\PermissionsController@getListarPermisos');
  Route::post('/administracion/permiso/setRegistrarPermiso', 'Administracion\PermissionsController@setRegistrarPermiso');
  Route::post('/administracion/permiso/setEditarPermiso', 'Administracion\PermissionsController@setEditarPermiso');

  Route::get('/administracion/funciones/getListarFunciones', 'Administracion\FuncionesController@getListarFunciones');
  Route::post('/administracion/funciones/setRegistrarFunciones', 'Administracion\FuncionesController@setRegistrarFunciones');
  Route::post('/administracion/funciones/setEditarFunciones', 'Administracion\FuncionesController@setEditarFunciones');

  Route::get('/administracion/actividades/getListarFuncionesUsuario', 'Administracion\ActividadesController@getListarFuncionesUsuario');
  Route::post('/administracion/actividades/getListarFuncionesUsuario', 'Administracion\ActividadesController@setRegistrarActividad');
  Route::get('/administracion/actividades/getListarActividades', 'Administracion\ActividadesController@getListarActividades');
  Route::post('/administracion/actividades/setGenerarDocumento', 'Administracion\ActividadesController@setGenerarDocumento');
  Route::get('/administracion/actividades/getListarUsuariosReceso', 'Administracion\ActividadesController@getListarUsuariosReceso');


  Route::post('/archivo/setRegistrarArchivo', 'FilesController@setRegistrarArchivo');

});



Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath')
  ->where('optional','.*');
