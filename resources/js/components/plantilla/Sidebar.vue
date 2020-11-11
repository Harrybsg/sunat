<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img :src="ruta + '/img/SunatLogo.jpg'"
             alt="SUNAT"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">SUNAT</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <template v-if="!usuario.file_id">
              <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2" :alt="usuario.fullname">
          </template>
          <template v-else>
              <img :src="usuario.file.path" class="img-circle elevation-2" :alt="usuario.fullname">
          </template>
        </div>
        <div class="info">
          <router-link class="d-block" :to="{name: 'usuario.ver', params:{id: usuario.id}}">
            {{usuario.fullname}}
          </router-link>
        </div>
      </div>
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block" @click.prevent="logout" v-loading.fullscreenLoading.lock="fullscreenLoading">
            <i class="fas fa-sign-out-alt"></i>Cerrar Sesión
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <template v-if="listPermisos.includes('dashboard.index')">
              <router-link class = "nav-link active" :to="'/'">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </template>
          </li>
          <el-menu default-active="2" class="el-menu-vertical-demo" :router="true">
            <li class="nav-header">Producción</li>
              <el-submenu index="1">
                <template slot="title">
                  <i class="el-icon-s-platform"></i>
                  <span>Producción</span>
                </template>
                <el-menu-item-group title="Auditoría">
                  <el-menu-item :index="'/fiscalizacion'"><i class="el-icon-folder"></i>Fiscalización
                  </el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Control de la deuda y cobranza">
                  <el-menu-item :index="'/controldc'"><i class="el-icon-folder"></i>ControlDyC</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Reclamaciones">
                  <el-menu-item :index="'/reclamaciones'"><i class="el-icon-folder"></i>Reclamaciones</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Servicios">
                  <el-menu-item :index="'/servicios'"><i class="el-icon-folder"></i>Servicios</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="OSA">
                  <el-menu-item :index="'/osa'"><i class="el-icon-folder"></i>OSA</el-menu-item>
                </el-menu-item-group>
              </el-submenu>
            <li class="nav-header">Stocks</li>
              <el-submenu index="2">
                <template slot="title">
                  <i class="el-icon-s-management"></i>
                  <span>Stocks</span>
                </template>
                <el-menu-item-group title="Auditoría">
                  <el-menu-item :index="'/fiscalizacionS'"><i class="el-icon-folder"></i>Fiscalización
                  </el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Control de la deuda y cobranza">
                  <el-menu-item :index="'/controldcS'"><i class="el-icon-folder"></i>ControlDyC</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Reclamaciones">
                  <el-menu-item :index="'/reclamacionesS'"><i class="el-icon-folder"></i>Reclamaciones</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="Servicios">
                  <el-menu-item :index="'/serviciosS'"><i class="el-icon-folder"></i>Servicios</el-menu-item>
                </el-menu-item-group>
                <el-menu-item-group title="OSA">
                  <el-menu-item :index="'/osaS'"><i class="el-icon-folder"></i>OSA</el-menu-item>
                </el-menu-item-group>
              </el-submenu>
          </el-menu>
          <template v-if="listPermisos.includes('usuario.index')">
            <li class="nav-header">Data crítica</li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('usuario.index')">
                <router-link class = "nav-link" :to="'/usuario'">
                  <i class="el-icon-folder"></i>
                  <p>Data</p>
                </router-link>
              </template>
            </li>
          </template>

          <template v-if="listPermisos.includes('usuario.index') || listPermisos.includes('rol.index') || listPermisos.includes('permiso.index') || listPermisos.includes('funciones.index')">
            <li class="nav-header">Administración</li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('usuario.index')">
                <router-link class = "nav-link" :to="'/usuario'">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Usuarios</p>
                </router-link>
              </template>
            </li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('rol.index')">
                <router-link class = "nav-link" :to="'/rol'">
                  <i class="nav-icon fas fa-unlock-alt"></i>
                  <p>Roles</p>
                </router-link>
              </template>
            </li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('permiso.index')">
                <router-link class = "nav-link" :to="'/permiso'">
                  <i class="nav-icon fas fa-key"></i>
                  <p>Permisos</p>
                </router-link>
              </template>
            </li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('funciones.index')">
                <router-link class = "nav-link" :to="'/funciones'">
                  <i class="nav-icon fas fa-key"></i>
                  <p>Funciones</p>
                </router-link>
              </template>
            </li>
          </template>
          <template v-if="listPermisos.includes('reporte.index')">
            <li class="nav-header">Reportes</li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('reporte.index')">
                <router-link class = "nav-link" :to="'/reporte'">
                  <i class="nav-icon fas fa-file-export"></i>
                  <p>Reporte actividades</p>
                </router-link>
              </template>
            </li>
          </template>
          <li class="nav-header">Control de trabajo</li>
          <li class="nav-item">
            <router-link class = "nav-link" :to="{name: 'control.crear', params:{id: usuario.id}}">
              <i class="nav-icon fas fa-file-export"></i>
              <p>Control</p>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
  export default {
    props: ['ruta','usuario','listPermisos'],
    data(){
      return{
        fullscreenLoading: false
      }
    },
    mounted(){

    },
    methods: {
      logout(){
        this.fullscreenLoading = true;
        var url = '/authenticate/logout'
        axios.post(url).then(response =>{
          if(response.data.code == 204){
            this.$router.push({name: 'login'})
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        }).catch(error => {
                    if (error.response.status == 401) {
                        this.$router.push({name: 'login'})
                        location.reload();
                        sessionStorage.clear();
                        this.fullscreenLoading = false;
                    }
          })
      },
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>
<style>
</style>
