<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Funcion</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/funciones'">
              <i class="fas fa-arrow-left">Regresar</i>
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
              <div class="card card-info">
                  <div class="card card-header">
                    <h3 class="card-tittle">Formulario editar funciones</h3>
                  </div>
                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nombre</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" v-model="fillEditarFunciones.cNombre" @keyup.enter="setEditarFunciones">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Función código</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" v-model="fillEditarFunciones.cFuncion_Code" @keyup.enter="setEditarFunciones">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarFunciones" v-loading.fullscreen.lock="fullscreenLoading">Editar</button>
                        <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
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
            <h5 class="modal-tittle">SUNAT</h5>
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
        fillEditarFunciones:{
          nIdFunciones: this.$attrs.id,
          cNombre: '',
          cFuncion_Code: ''
        },
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
    computed:{

    },
    mounted(){
      this.getListarFunciones();
    },
    methods:{
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      validarEditarFunciones(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.fillEditarFunciones.cNombre){
          this.mensajeError.push('El nombre es obligatorio');
        }
        if(!this.fillEditarFunciones.cFuncion_Code){
          this.mensajeError.push('El código función es obligatorio');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      getListarFunciones(){
        this.fullscreenLoading = true;
        var url = '/administracion/funciones/getListarFunciones'
        axios.get(url, {
          params:{
            'nIdFunciones' : this.fillEditarFunciones.nIdFunciones
          }
        }).then(response => {
          this.fillEditarFunciones.cNombre = response.data[0].name;
          this.fillEditarFunciones.cFuncion_Code = response.data[0].code_name;
          this.fullscreenLoading = false;
        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      },
      setEditarFunciones(){
        if(this.validarEditarFunciones()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        var url = '/administracion/funciones/setEditarFunciones'
        axios.post(url, {
          'nIdFunciones' : this.fillEditarFunciones.nIdFunciones,
          'cNombre' : this.fillEditarFunciones.cNombre,
          'cFuncion_Code' : this.fillEditarFunciones.cFuncion_Code
        }).then(response => {
          this.fullscreenLoading = false;
          Swal.fire({
            icon: 'success',
            title: 'Se actualizó la función correctamente',
            showConfirmButton: false,
            timer: 1500
          })
        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      },
      limpiarCriterios(){
        this.fillEditarFunciones.cNombre = '';
        this.fillEditarFunciones.cFuncion_Code = '';
      }
    }
  }
</script>
<style>
</style>
