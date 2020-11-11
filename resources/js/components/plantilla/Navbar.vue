<template>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <template v-if="listPermisos.includes('dashboard.index')">
        <div>
          <li class="nav-item d-none d-sm-inline-block">
            <router-link class="nav-link" :to="{ name: 'dashboard.index'}">Inicio</router-link>
          </li>
        </div>
      </template>
      <template v-if="listPermisos.includes('reporte.index')">
        <div>
          <li class="nav-item d-none d-sm-inline-block">
            <router-link class="nav-link" :to="{ name: 'reporte.index'}">Reportes</router-link>
          </li>
        </div>
      </template>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <el-autocomplete
          class="inline-input"
          v-model="state2"
          :fetch-suggestions="querySearch"
          placeholder="Buscar..."
          :trigger-on-focus="true"
          size="small"
          @select="handleSelect">
          <i
          class="el-icon-search el-input__icon"
          slot="suffix">
          </i>
        </el-autocomplete>
      </div>
    </form>


  </nav>
  <!-- /.navbar -->
</template>
<script>
  export default {
    props: ['ruta', 'listPermisos','usuario'],
    data(){
      return{
        state2: '',
        links: [],
        listRolPermisosByUsuario: [],
        listRolPermisosByUsuarioFilter: []
      }
    },
    methods: {
      querySearch(queryString, cb) {
        var links = this.listRolPermisosByUsuarioFilter;
        var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        // call callback function to return suggestions
        cb(results);
      },
      createFilter(queryString) {
        return (link) => {
          return (link.value.toLowerCase().indexOf(queryString.toLowerCase()) != -1);
        };
      },
      getListarRolPermisosByUsuario(){
        var ruta = '/administracion/usuario/getListarRolPermisosByUsuario'
        axios.get(ruta,{
          params: {
            'nIdUsuario' : this.usuario.id
          }
        }).then(response => {
          this.listRolPermisosByUsuario = response.data;
          this.filtrarListarRolPermisosByUsuario();
        }).catch(error => {
                    if (error.response.status == 401) {
                        this.$router.push({name: 'login'})
                        location.reload();
                        sessionStorage.clear();
                        this.fullscreenLoading = false;
                    }
          })
      },
      filtrarListarRolPermisosByUsuario(){
        let me = this;
        me.listRolPermisosByUsuarioFilter = [];
        me.listRolPermisosByUsuario.map(function(x,y){
          if(x.slug.includes('index')){
            me.listRolPermisosByUsuarioFilter.push({
              'value': x.name,
              'link': x.slug
            })
          }

        })
      },
      handleSelect(item) {
        if (this.$route.name != item.link) {
                  this.$router.push({name: item.link})
                  this.cBusqueda = ''
        } else {
            this.cBusqueda = ''
        }
      }
    },
    mounted() {
      EventBus.$on('notifyRolPermisosByUsuario', data => {
                this.getListarRolPermisosByUsuario();
      })
      this.getListarRolPermisosByUsuario();
    }
  }
</script>
<style>

</style>
