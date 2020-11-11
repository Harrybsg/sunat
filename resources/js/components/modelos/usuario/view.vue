<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuario</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="row">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <template v-if="!fillVerUsuario.cRutaArchivo">
                      <img src="/img/avatar.png" class="profile-user-img img-fluid img-circle img-max-height" alt="Foto perfil usuario">
                  </template>
                  <template v-else>
                      <img :src="fillVerUsuario.cRutaArchivo" class="profile-user-img img-fluid img-circle img-max-height" :alt="cNombreCompleto">
                  </template>
                </div>

                <h3 class="profile-username text-center">{{cNombreCompleto}}</h3>

                <p class="text-muted text-center">{{fillVerUsuario.cNombreRol}}</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Acerda de mí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-mailchimp"></i> Nombre completo</strong>
                <p class="text-muted" v-text="cNombreCompleto"></p>
                <hr>
                <strong><i class="fas fa-envelope-open-text"></i> Correo electrónico</strong>
                <p class="text-muted" v-text="fillVerUsuario.cCorreo"></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills position-reverse">
                  <li class="nav-item">
                    <router-link class="nav-link active" :to="'/usuario'">
                      <i class="fas fa-arrow-left"></i>Regresar
                    </router-link>
                  </li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Primer Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditarUsuario.cPrimerNombre" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Segundo Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditarUsuario.cSegundoNombre" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellido</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditarUsuario.cApellido" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditarUsuario.cUsuario" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo electrónico</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" v-model="fillEditarUsuario.cCorreo" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contraseña</label>
                        <div class="col-md-9">
                          <el-input placeholder="Ingrese contraseña" v-model="fillEditarUsuario.cContraseña" @keyup.enter="setEditarUsuario" show-password></el-input>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fotografia</label>
                        <div class="col-md-9">
                          <input type="file" class="form-control" @change="getFile">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <button class="btn btn-flat btn-info btnFull" @click.prevent="setEditarUsuario" v-loading.fullscreen.lock="fullscreenLoading">Editar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
      </div>
    </div>

    <div class="modal fade" :class="{ show : modalShow}" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-tittle">Easy App Web</h5>
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
  export default {
    data(){
      return{
        fillEditarUsuario:{
          nIdUsuario : this.$attrs.id,
          cPrimerNombre: '',
          cSegundoNombre: '',
          cApellido: '',
          cUsuario: '',
          cCorreo: '',
          cContraseña: '',
          oFotografia: ''
        },
        fillVerUsuario:{
          nIdUsuario : this.$attrs.id,
          cPrimerNombre: '',
          cSegundoNombre: '',
          cApellido: '',
          cUsuario: '',
          cCorreo: '',
          cContraseña: '',
          oFotografia: '',
          cRutaArchivo: '',
          cNombreRol: ''
        },
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
    computed:{
      cNombreCompleto(){
        return this.fillVerUsuario.cPrimerNombre + ' ' + this.fillVerUsuario.cSegundoNombre + ' ' + this.fillVerUsuario.cApellido;
      }
    },
    mounted(){
      this.getUsuarioById();
      this.getRolByUsuario();
    },
    methods: {
      getUsuarioById(){
        this.fullscreenLoading = true;
        var url = '/administracion/usuario/getListarUsuarios'
        axios.get(url, {
          params:{
            'nIdUsuario' : this.fillEditarUsuario.nIdUsuario
          }
        }).then(response => {
          this.getUsuarioEditar(response.data[0])
          this.getUsuarioVer(response.data[0])
          this.fullscreenLoading = false;
        })
      },
      getUsuarioEditar(data){
        this.fillEditarUsuario.cPrimerNombre = data.firstname;
        this.fillEditarUsuario.cSegundoNombre = data.secondname;
        this.fillEditarUsuario.cApellido = data.lastname;
        this.fillEditarUsuario.cUsuario = data.username;
        this.fillEditarUsuario.cCorreo = data.email;
      },
      getUsuarioVer(data){
        this.fillVerUsuario.cPrimerNombre = data.firstname;
        this.fillVerUsuario.cSegundoNombre = data.secondname;
        this.fillVerUsuario.cApellido = data.lastname;
        this.fillVerUsuario.cUsuario = data.username;
        this.fillVerUsuario.cCorreo = data.email;
        this.fillVerUsuario.cRutaArchivo = data.profile_image;
      },
      getRolByUsuario(){
        var url = '/administracion/usuario/getRolByUsuario'
        axios.get(url,{
          params: {
            'nIdUsuario' : this.fillVerUsuario.nIdUsuario
          }
        }).then(response => {
          this.fillVerUsuario.cNombreRol = (response.data.length == 0) ? '' : response.data[0].name;
          this.fullscreenLoading = false;
        })
      },
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getFile(e){
        this.fillEditarUsuario.oFotografia = e.target.files[0];
      },
      setEditarUsuario(){
        if(this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        if(!this.fillEditarUsuario.oFotografia || this.fillEditarUsuario.oFotografia == undefined){
          this.setGuardarUsuario(0);
        } else{
          this.setRegistrarArchivo();
        }
      },
      validarRegistrarUsuario(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.fillEditarUsuario.cPrimerNombre){
          this.mensajeError.push('El primer nombre es obligatorio');
        }
        if(!this.fillEditarUsuario.cApellido){
          this.mensajeError.push('El Apellido nombre es obligatorio');
        }
        if(!this.fillEditarUsuario.cUsuario){
          this.mensajeError.push('El Usuario nombre es obligatorio');
        }
        if(!this.fillEditarUsuario.cCorreo){
          this.mensajeError.push('El Correo nombre es obligatorio');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      setGuardarUsuario(nIdFile){
        var url = '/administracion/usuario/setEditarUsuario'
        axios.post(url, {
          'nIdUsuario' : this.fillEditarUsuario.nIdUsuario,
          'cPrimerNombre': this.fillEditarUsuario.cPrimerNombre,
          'cSegundoNombre': this.fillEditarUsuario.cSegundoNombre,
          'cApellido': this.fillEditarUsuario.cApellido,
          'cUsuario': this.fillEditarUsuario.cUsuario,
          'cCorreo': this.fillEditarUsuario.cCorreo,
          'cContraseña': this.fillEditarUsuario.cContraseña,
          'oFotografia': nIdFile,
        }).then(response => {
          this.getRefrescarUsuarioAutenticado();

        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      },
      setRegistrarArchivo(){
        this.form.append('file', this.fillEditarUsuario.oFotografia)
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
      getRefrescarUsuarioAutenticado(){
        var url = '/authenticate/getRefrescarUsuarioAutenticado'
        axios.get(url).then(response =>{
          EventBus.$emit('verifyAuthenticatedUser', response.data);
          this.fullscreenLoading = false;
          this.getUsuarioById();
          Swal.fire({
            icon: 'success',
            title: 'Se actualiazó correctamente',
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
      }
    }
  }
</script>

<style lang="css" scoped>
  .position{
    flex-direction: row-reverse !important;
  }
  .img-max-height{
    max-height: 100px !important;
  }
</style>
