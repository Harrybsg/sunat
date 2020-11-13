<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Funcion</h1>
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
                  <div class="card card-header" style="background-color: #A10328;">
                    <h3 class="card-title">Formulario registrar funciones</h3>
                  </div>
                  <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nombre</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" v-model="fillCrearFunciones.cNombre" @keyup.enter="setRegistrarFunciones">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Función código</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" v-model="fillCrearFunciones.cFuncion_Code" @keyup.enter="setRegistrarFunciones">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarFunciones" v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
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
        fillCrearFunciones:{
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
    methods:{
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      validarRegistrarFunciones(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.fillCrearFunciones.cNombre){
          this.mensajeError.push('El nombre es obligatorio');
        }
        if(!this.fillCrearFunciones.cFuncion_Code){
          this.mensajeError.push('El código función es obligatorio');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      setRegistrarFunciones(){
        if(this.validarRegistrarFunciones()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        var url = '/administracion/funciones/setRegistrarFunciones'
        axios.post(url, {
          'cNombre' : this.fillCrearFunciones.cNombre,
          'cFuncion_Code' : this.fillCrearFunciones.cFuncion_Code
        }).then(response => {
          this.fullscreenLoading = false;
          this.$router.push('/funciones');
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
        this.fillCrearFunciones.cNombre = '';
        this.fillCrearFunciones.cFuncion_Code = '';
      }
    }
  }
</script>
<style>
</style>
