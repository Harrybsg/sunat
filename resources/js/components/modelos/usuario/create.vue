<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear usuario</h1>
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
            <div class="card card-header">
              <h3 class="card-tittle">Formulario registrar usuario</h3>
            </div>
            <div class="card-body">
              <form role="form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Primer Nombre</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearUsuario.cPrimerNombre" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Segundo Nombre</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearUsuario.cSegundoNombre" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Apeliido</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearUsuario.cApellido" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Código de usuario</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearUsuario.cUserCode" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Usuario</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" v-model="fillCrearUsuario.cUsuario" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Correo</label>
                      <div class="col-md-9">
                        <input type="email" class="form-control" v-model="fillCrearUsuario.cCorreo" @keyup.enter="setRegistrarUsuario">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Contraseña</label>
                      <div class="col-md-9">
                        <el-input placeholder="Ingrese contraseña" v-model="fillCrearUsuario.cContraseña" @keyup.enter="setRegistrarUsuario" show-password></el-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Rol</label>
                      <div class="col-md-9">
                        <el-select v-model="fillCrearUsuario.nIdRol" placeholder="Seleccione un rol" clearable>
                          <el-option
                            v-for="item in listRoles"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                          </el-option>
                        </el-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Fotografia</label>
                      <div class="col-md-9">
                        <input type="file" class="form-control" @change="getFile">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-4 offset-4">
                  <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarUsuario" v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
                  <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
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
        fillCrearUsuario:{
          cPrimerNombre: '',
          cSegundoNombre: '',
          cApellido: '',
          cUserCode: '',
          cUsuario: '',
          cCorreo: '',
          cContraseña: '',
          oFotografia: '',
          nIdRol: ''
        },
        listRoles: [],
        form : new FormData,
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
      this.getListarRoles();
    },
    computed:{

    },
    methods:{
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getFile(e){
        this.fillCrearUsuario.oFotografia = e.target.files[0];
      },
      setRegistrarUsuario(){
        if(this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        if(!this.fillCrearUsuario.oFotografia || this.fillCrearUsuario.oFotografia == undefined){
          this.setGuardarUsuario(0);
        } else{
          this.setRegistrarArchivo();
        }
      },
      validarRegistrarUsuario(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.fillCrearUsuario.cPrimerNombre){
          this.mensajeError.push('El primer nombre es obligatorio');
        }
        if(!this.fillCrearUsuario.cApellido){
          this.mensajeError.push('El Apellido es obligatorio');
        }
        if(!this.fillCrearUsuario.cUserCode){
          this.mensajeError.push('El código de usuario es obligatorio');
        }
        if(!this.fillCrearUsuario.cUsuario){
          this.mensajeError.push('El Usuario es obligatorio');
        }
        if(!this.fillCrearUsuario.cCorreo){
          this.mensajeError.push('El Correo es obligatorio');
        }
        if(!this.fillCrearUsuario.cContraseña){
          this.mensajeError.push('El Contraseña nombre es obligatorio');
        }
        if(!this.fillCrearUsuario.nIdRol){
          this.mensajeError.push('El rol es obligatorio');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      setRegistrarArchivo(){
        this.form.append('file', this.fillCrearUsuario.oFotografia)
        const config = { headers: {'Content-Type' : 'multipart/form-data'}}
        var url = '/archivo/setRegistrarArchivo'
        axios.post(url, this.form, config).then(response=>{
          console.log(response)
          var nIdFile = response.data[0].nIdFile;
          this.setGuardarUsuario(nIdFile);
        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      },
      setGuardarUsuario(nIdFile){
        var url = '/administracion/usuario/setRegistrarUsuario'
        axios.post(url, {
          'cPrimerNombre': this.fillCrearUsuario.cPrimerNombre,
          'cSegundoNombre': this.fillCrearUsuario.cSegundoNombre,
          'cApellido': this.fillCrearUsuario.cApellido,
          'cUserCode': this.fillCrearUsuario.cUserCode,
          'cUsuario': this.fillCrearUsuario.cUsuario,
          'cCorreo': this.fillCrearUsuario.cCorreo,
          'cContraseña': this.fillCrearUsuario.cContraseña,
          'oFotografia': nIdFile
        }).then(response => {
          this.setEditarRolByUsuario(response.data);
        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      },
      getListarRoles(){
        this.fullscreenLoading = true;
        var url = '/administracion/rol/getListarRoles'
        axios.get(url).then(response => {
          this.listRoles = response.data;
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
      setEditarRolByUsuario(nIdUsuario){
        var url = '/administracion/usuario/setEditarRolByUsuario'
        axios.post(url, {
          'nIdUsuario': nIdUsuario,
          'nIdRol': this.fillCrearUsuario.nIdRol
        }).then(response => {
          this.fullscreenLoading = false;
          this.$router.push('/usuario');
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
        this.fillCrearUsuario.cPrimerNombre = '';
        this.fillCrearUsuario.cSegundoNombre = '';
        this.fillCrearUsuario.cApellido = '';
        this.fillCrearUsuario.cUserCode = '';
        this.fillCrearUsuario.cUsuario = '';
        this.fillCrearUsuario.cCorreo = '';
        this.fillCrearUsuario.cContraseña = '';
        this.fillCrearUsuario.oFotografia = '';
      }
    }
  }
</script>
<style>
</style>
