<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignar Funciones</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/usuario'">
              <i class="fas fa-arrow-left">Regresar</i>
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-5">
                <div class="card card-info">
                  <div class="card card-header">
                    <h3 class="card-title">Listar Permisos del Usuario {{fillFunciones.cNombreUsuario}}</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <template v-if="listFuncionesByUsuario.length">
                      <div class="scrollTable">
                        <table class="table table-hover table-head-fixed text-nowrap projects">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Código Función</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in listFuncionesByUsuario" :key="index">

                              <td v-text="item.name"></td>
                              <td v-text="item.code_name"></td>

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </template>
                    <template v-else>
                      <div class="callout callout-info">
                        <h5>No se encontraron registros...</h5>
                      </div>
                    </template>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarFuncionesByUsuario" v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="card card-info">
                  <div class="card card-header">
                    <h3 class="card-title">Listar Permisos</h3>
                  </div>
                  <div class="card-body table-responsive">
                    <template v-if="listFuncionesFilter.length">
                      <div class="scrollTable">
                        <table class="table table-hover table-head-fixed text-nowrap projects">
                          <thead>
                            <tr>
                              <th>Acción</th>
                              <th>Nombre</th>
                              <th>Código Función</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in listFuncionesFilter" :key="index" @click.prevent="marcarFila(index)">
                              <td>
                                <!--checkbox-->
                                <el-checkbox v-model="item.checked"></el-checkbox>
                              </td>
                              <td v-text="item.name"></td>
                              <td v-text="item.code_name"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </template>
                    <template v-else>
                      <div class="callout callout-info">
                        <h5>No se encontraron registros...</h5>
                      </div>
                    </template>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" :class="{ show : modalShow}" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SUNAT</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item">

            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
  export default{
    data(){
      return{
        fillFunciones:{
          nIdUsuario: this.$attrs.id,
          cNombreUsuario: ''
        },
        listFuncionesByUsuario: [],
        listFunciones: [],
        listFuncionesFilter: [],
        listUserFuncionesByUsuario: [],
        listUserFuncionesByUsuarioFilter: [],
        fullscreenLoading: false,
        modalShow: false,
        mostrarModal:{
          display: 'block',
          background: '#0000006b',
        },
        ocultarModal:{
          display: 'none',
        },
        error: 0,
        mensajeError: [],
      }
    },
    mounted(){
      this.getListarFuncionesByUsuarioAsignado();
      this.getNombreByUsuario();
      this.getListarFuncionesByUsuario();
    },
    computed:{

    },
    methods:{
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getListarFuncionesByUsuario(){
        var ruta = '/administracion/usuario/getListarFuncionesByUsuario'
        axios.get(ruta,{
          params: {
            'nIdUsuario' : this.fillFunciones.nIdUsuario
          }
        }).then(response => {
          this.listFunciones = response.data;
          this.filtrarFuncionesByUsuario();
        })
      },
      getListarFuncionesByUsuarioAsignado(){
        var ruta = '/administracion/usuario/getListarFuncionesByUsuarioAsignado'
        axios.get(ruta,{
          params:{
            'nIdUsuario'  : this.fillFunciones.nIdUsuario
          }
        }).then(response => {
          this.listFuncionesByUsuario = response.data;
        })
      },
      getNombreByUsuario(){
        var url = '/administracion/usuario/getNombreByUsuario'
        axios.get(url,{
          params: {
            'nIdUsuario' : this.fillFunciones.nIdUsuario
          }
        }).then(response => {
          this.fillFunciones.cNombreUsuario = (response.data.length == 0) ? '' : (response.data[0].firstname + ' ' + response.data[0].lastname);
          this.fullscreenLoading = false;
        })
      },
      validarRegistrarFuncionesByUsuario(){
        this.error = 0;
        this.mensajeError = [];
        let contador = 0;
        this.listFuncionesFilter.map(function(x,y){
          if(x.checked == true){
            contador++;
          }
        })
        if(contador == 0){
          this.mensajeError.push('Debe seleccionar al menos una función');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      setRegistrarFuncionesByUsuario(){
        if(this.validarRegistrarFuncionesByUsuario()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        var url = '/administracion/usuario/setRegistrarFuncionesByUsuario'
        axios.post(url, {
          'nIdUsuario' : this.fillFunciones.nIdUsuario,
          'listFuncionesFilter' : this.listFuncionesFilter
        }).then(response => {
          this.getListarUserFuncionesByUsuario();
        })
      },
      getListarUserFuncionesByUsuario(){
        var ruta = '/administracion/usuario/getListarUserFuncionesByUsuario'
        axios.get(ruta).then(response => {
          this.listUserFuncionesByUsuario = response.data;
          this.filtrarListarUserFuncionesByUsuario();
        })
      },
      filtrarListarUserFuncionesByUsuario(){
        let me = this;
        me.listUserFuncionesByUsuarioFilter = [];
        me.listUserFuncionesByUsuario.map(function(x,y){
          me.listUserFuncionesByUsuarioFilter.push(x.code_name)
        })
        sessionStorage.setItem('listUserFuncionesByUsuario', JSON.stringify(me.listUserFuncionesByUsuarioFilter));
        EventBus.$emit('notifyUserFuncionesByUsuario', me.listUserFuncionesByUsuarioFilter);
        this.fullscreenLoading = false;
        Swal.fire({
          icon: 'success',
          title: 'Se otorgaron las funciones correctamente',
          showConfirmButton: false,
          timer: 1500
        })
      },
      filtrarFuncionesByUsuario(){
        let me = this;
        me.listFunciones.map(function(x,y){
            me.listFuncionesFilter.push({
              'id' : x.id,
              'name' : x.name,
              'code_name' : x.code_name,
              'checked': (x.checked == 1) ? true: false
            })
          })
      },
      marcarFila(index){
        this.listFuncionesFilter[index].checked = !this.listFuncionesFilter[index].checked;
      }
    }
  }
</script>
<style>
</style>
