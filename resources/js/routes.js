import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

function verificarAcceso(to, from, next){
  let authUser = JSON.parse(sessionStorage.getItem('authUser'));
  if(authUser){
    let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
    if(listRolPermisosByUsuario.includes(to.name)){
      next();
    }else{
      let listRolPermisosByUsuarioFilter = [];
      listRolPermisosByUsuario.map(function(x){
        if(x.includes('index')){
          listRolPermisosByUsuarioFilter.push(x);
        }
      })
      if(to.name == 'dashboard.index'){
        next({name:listRolPermisosByUsuarioFilter[0]});
      }
      else{
        next(from.path);
      }
    }
  }else{
    next('/login')
  }
}

export const rutas = [
  { path: '/', name: 'dashboard.index', component: require('./components/modelos/dashboard/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '*', component: require('./components/plantilla/404').default
  },
  { path: '/login', name: 'login', component: require('./components/modelos/authenticate/login').default,
    beforeEnter: (to, from, next) => {
      let authUser = JSON.parse(sessionStorage.getItem('authUser'));
      if(authUser){
        next({ name: 'dashboard.index'});
      }else{
        next();
      }
    }
  },
  { path: '/permiso', name: 'permiso.index', component: require('./components/modelos/permiso/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/permiso/crear', name:'permiso.crear', component: require('./components/modelos/permiso/create').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/permiso/editar/:id', name:'permiso.editar', component: require('./components/modelos/permiso/edit').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/reporte', name:'reporte.index', component: require('./components/modelos/reporte/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/control/:id', name:'control.index', component: require('./components/modelos/control/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    },
    props:true
  },
  { path: '/control/crear/:id', name:'control.crear', component: require('./components/modelos/control/create').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    },
    props: true
  },
  { path: '/rol', name:'rol.index', component: require('./components/modelos/rol/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/rol/crear', name:'rol.crear', component: require('./components/modelos/rol/create').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/rol/editar/:id', name: 'rol.editar', component: require('./components/modelos/rol/edit').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/usuario', name: 'usuario.index',component: require('./components/modelos/usuario/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/usuario/crear', name:'usuario.crear', component: require('./components/modelos/usuario/create').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/usuario/editar/:id', name: 'usuario.editar', component: require('./components/modelos/usuario/edit').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/usuario/ver/:id', name: 'usuario.ver', component: require('./components/modelos/usuario/view').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/usuario/permiso/:id', name: 'usuario.permiso', component: require('./components/modelos/usuario/permission').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/usuario/funciones/:id', name: 'usuario.funciones', component: require('./components/modelos/usuario/functions').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/funciones', name: 'funciones.index', component: require('./components/modelos/funciones/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/funciones/crear', name: 'funciones.crear', component: require('./components/modelos/funciones/create').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/funciones/editar/:id', name: 'funciones.editar', component: require('./components/modelos/funciones/edit').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
    ,props: true
  },
  { path: '/fiscalizacion', name: 'fiscalizacion.index', component: require('./components/modelos/menu/produccion/auditoria/fiscalizacion/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/controldc', name: 'controldc.index', component: require('./components/modelos/menu/produccion/controldc/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/osa', name: 'osa.index', component: require('./components/modelos/menu/produccion/osa/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/reclamaciones', name: 'reclamaciones.index', component: require('./components/modelos/menu/produccion/reclamaciones/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/servicios', name: 'servicios.index', component: require('./components/modelos/menu/produccion/servicios/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/fiscalizacionS', name: 'fiscalizacionS.index', component: require('./components/modelos/menu/stocks/auditoria/fiscalizacion/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/controldcS', name: 'controldcS.index', component: require('./components/modelos/menu/stocks/controldc/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/osaS', name: 'osaS.index', component: require('./components/modelos/menu/stocks/osa/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/reclamacionesS', name: 'reclamacionesS.index', component: require('./components/modelos/menu/stocks/reclamaciones/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
  { path: '/serviciosS', name: 'serviciosS.index', component: require('./components/modelos/menu/stocks/servicios/index').default,
    beforeEnter: (to, from, next) => {
      verificarAcceso(to, from, next);
    }
  },
]

export default new Router({
  routes: rutas,
  mode: 'history',
  linkActiveClass: 'active'
})
