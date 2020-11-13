<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Control de trabajo</h1>
          </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card card-header" style="background-color: #A10328;">
                <h3 class="card-title">Formulario registrar actividad</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fecha de Actividad</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="getFecha" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Hora actual</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="getHora" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Actividad</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="textActividad" placeholder="Escriba su actividad" :readonly="trabajando">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Función</label>
                        <div class="col-md-9">
                          <el-select v-model="fillCrearActividad.nIdFuncion" placeholder="Seleccione la función" clearable>
                            <el-option
                              v-for="(item, index) in listFuncionesByUsuario" :key="index"
                              :label="item.name"
                              :value="item.nIdFuncion">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Hora de inicio de actividad</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="iniActi" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tiempo de actividad transcurrido</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="tiempo" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tiempo total transcurrido</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control"  v-model="getTiempoTranscurrido" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tiempo fin</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="terActi" readonly="readonly">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-8 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" style="background-color: #A10328;" @click.prevent="setRegistrarActividad" v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="iniciarContador" :disabled='trabajando'>{{textoInicio}}</button>
                    <button class="btn btn-flat btn-default btnWidth" v-show="!corrigiendo && getEsTiempo" @click.prevent="corregirActividad" >Corregir actividad</button>
                    <button class="btn btn-flat btn-default btnWidth" v-show="corrigiendo && getEsTiempo" @click.prevent="terminarCorrecionActividad" >Terminar Correción</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="terminarActividad">Terminar actividad</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiar">Limpiar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="finalizarTrabajo">Finalizar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card card-header" style="background-color: #A10328;">
                <h3 class="card-title d-flex">Actividades de Hoy
                  <button class="btn btn-info btn-sm ml-auto" @click.prevent="setGenerarDocumento">
                    <i class="fas fa-plus-square">Generar Reporte</i>
                  </button>
                </h3>
              </div>
              <div class="card-body table-responsive">
                <template v-if="listActividadesUsuario.length">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Actividad</th>
                        <th>Función</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Tiempo transcurrido</th>
                        <th>Tiempo fin</th>
                      </tr>
                    </thead>
                    <tbody >
                      <tr v-for="(item, index) in listActividadesUsuario" :key="index">
                        <td>{{item.activity}}</td>
                        <td>{{item.cCode}}</td>
                        <td>{{item.cUser}}</td>
                        <td>{{item.start_date}}</td>
                        <td>{{item.start_time}}</td>
                        <td>{{item.trasnscurred_time}}</td>
                        <td>{{item.finished_time}}</td>
                      </tr>
                    </tbody>
                  </table>
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
      data() {
        return {
          fillCrearActividad:{
            nIdUsuario: this.$attrs.id,
            nIdFuncion: ''
          },
          hora: 0,minutos: 0,segundos: 0,
          trabajando: false,
          aTiempo: true,
          corrigiendo: false,
          textActividad: "",
          textoInicio: 'Iniciar Actividad',
          iniActi: 0,terActi:0,
          horaIni:0,minutoIni:0,segundoIni:0,
          h1:new Date(),h2:new Date(),
          tiempo:'',
          funciones:[],
          fechaHoy: 0,
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
          fullscreenLoading: false,
          listFunciones: [],
          listFuncionesByUsuario: [],
          listActividadesUsuario: []
        }
    },
    created(){
      var self = this;
      setInterval(function(){
        self.actualizarTiempo();
      },1000);
    },
    mounted(){
      this.getListarFuncionesUsuario();
      this.getListarActividades();
      if (localStorage.getItem('trabajando')) {
        this.trabajando = JSON.parse(localStorage.getItem('trabajando'));
      }
      if (localStorage.iniActi) {
        this.iniActi = localStorage.iniActi;
      }
      if (localStorage.terActi) {
        this.terActi = localStorage.terActi;
      }
      if (localStorage.horaIni) {
        this.horaIni = localStorage.horaIni;
      }
      if (localStorage.minutoIni) {
        this.minutoIni = localStorage.minutoIni;
      }
      if (localStorage.segundoIni) {
        this.segundoIni = localStorage.segundoIni;
      }
      if(localStorage.tiempo){
        this.tiempo = localStorage.tiempo;
      }
      if(localStorage.textActividad){
        this.textActividad = localStorage.textActividad;
      }
    },
    methods: {
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      iniciarContador: function (){
        if(this.validarIniciarActividad()){
          this.modalShow = true;
          return;
        }
        this.trabajando = true;
        this.setTrabajando();
        this.textoInicio = "Actividad Iniciada";
        this.iniActi = this.hora +":"+ this.minutos + ":" + this.segundos;
        localStorage.iniActi = this.iniActi;
        this.horaIni = this.hora;
        this.minutoIni = this.minutos;
        this.segundoIni = this.segundos;
        localStorage.horaIni = this.horaIni;
        localStorage.minutoIni = this.minutoIni;
        localStorage.segundoIni = this.segundoIni;
        localStorage.textActividad = this.textActividad;
      },
      corregirActividad(){
        this.trabajando = false;
        this.setTrabajando();
        this.corrigiendo = true;
      },
      terminarCorrecionActividad(){
        this.trabajando = true;
        this.setTrabajando();
        this.corrigiendo = false;
      },
      terminarActividad(){
        this.terActi = this.hora +":"+ this.minutos + ":" + this.segundos;
        localStorage.terActi = this.terActi;
        this.tiempo = this.h1.getHours() + ":" + this.h1.getMinutes() + ":" + this.h1.getSeconds();
        localStorage.tiempo = this.tiempo;
        this.textoInicio = "Iniciar Actividad";
      },
      setTrabajando(){
        const parsed = JSON.stringify(this.trabajando);
        localStorage.setItem('trabajando', parsed);
      },
      actualizarTiempo(){
        var date = new Date(Date.now());
        this.hora = date.getHours();
        this.minutos = date.getMinutes();
        this.segundos = date.getSeconds();
        this.hora = this.hora > 9 ? this.hora : '0' + this.hora;
        this.minutos = this.minutos > 9 ? this.minutos : '0' + this.minutos;
        this.segundos = this.segundos > 9 ? this.segundos : '0' + this.segundos;
      },
      limpiar(){
        this.iniActi = 0 +":"+ 0 + ":" + 0;
        this.terActi = 0 +":"+ 0 + ":" + 0;
        this.tiempo = 0 + ":" + 0 + ":" + 0;
        this.textActividad = "";
        localStorage.iniActi = this.iniActi;
        localStorage.terActi = this.terActi;
        localStorage.tiempo = this.tiempo;
        localStorage.textActividad = this.textActividad;
      },
      finalizarTrabajo(){
        this.trabajando = false;
      },
      getListarActividades(){
        var ruta = '/administracion/actividades/getListarActividades'
        axios.get(ruta,{
          params:{
            'nIdUsuario'  : this.fillCrearActividad.nIdUsuario
          }
        }).then(response => {
          console.log(response.data);
          this.listActividadesUsuario = response.data;
        })
      },
      getListarFuncionesUsuario(){
        var ruta = '/administracion/actividades/getListarFuncionesUsuario'
        axios.get(ruta,{
          params:{
            'nIdUsuario'  : this.fillCrearActividad.nIdUsuario
          }
        }).then(response => {
          this.listFuncionesByUsuario = response.data;
        })
      },
      setRegistrarActividad(){
        if(this.validarRegistrarActividad()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        var url = '/administracion/actividades/getListarFuncionesUsuario'
        //var idF = this.getIdFuncion(this.fillCrearActividad.nIdFuncion);
        axios.post(url, {
          'cActivity' : this.textActividad,
          'nIdFuncion': this.fillCrearActividad.nIdFuncion,
          'nIdUsuario' : this.fillCrearActividad.nIdUsuario,
          'dFechaIni' : this.fechaHoy,
          'tHoraIni' : this.iniActi,
          'tTiempoTranscurrido' : this.tiempo,
          'tTerActi' : this.terActi
        }).then(response => {
          this.fullscreenLoading = false;
          Swal.fire({
            icon: 'success',
            title: 'Se registró su actividad correctamente',
            showConfirmButton: false,
            timer: 1500
          }).catch(error =>{
            if(error.response.status == 401){
              this.$router.push({name: 'login'});
              location.reload();
              sessionStorage.clear();
              this.fullscreenLoading = false;
            }
          })
        })
        this.limpiar();
        this.trabajando = false;
        this.setTrabajando();
      },
      validarRegistrarActividad(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.textActividad){
          this.mensajeError.push('La actividad es obligatorio');
        }
        if(!this.fillCrearActividad.nIdFuncion){
          this.mensajeError.push('La función es obligatoria');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      validarIniciarActividad(){
        this.error = 0;
        this.mensajeError = [];
        if(!this.textActividad){
          this.mensajeError.push('Llene la actividad ');
        }
        if(!this.fillCrearActividad.nIdFuncion){
          this.mensajeError.push('Llene la función');
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
      },
      setGenerarDocumento(){
        var config = {
          responseType: 'blob'
        }

        var ruta = '/administracion/actividades/setGenerarDocumento'
        axios.post(ruta,{
            'nIdUsuario'  : this.fillCrearActividad.nIdUsuario
        }, config).then(response => {
          var oMyBlob = new Blob([response.data], {type : 'application/pdf'});
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
        }).catch(error =>{
          if(error.response.status == 401){
            this.$router.push({name: 'login'});
            location.reload();
            sessionStorage.clear();
            this.fullscreenLoading = false;
          }
        })
      }
    },
    computed: {
      getHora(){
        return this.hora +":"+ this.minutos + ":" + this.segundos;
      },
      getFecha(){
        this.fechaHoy = moment().format("YYYY-MM-DD");
        return this.fechaHoy;
      },
      getTiempoTranscurrido(){
        this.h1.setHours(this.hora,this.minutos,this.segundos);
        this.h2.setHours(this.horaIni,this.minutoIni,this.segundoIni);
        this.h1.setHours(this.h1.getHours() - this.h2.getHours(), this.h1.getMinutes() - this.h2.getMinutes(), this.h1.getSeconds() - this.h2.getSeconds());
        return this.h1.getHours() + ":" + this.h1.getMinutes() + ":" + this.h1.getSeconds();
      },
      getTiempoTotal(){
        this.h1.setHours(this.hora,this.minutos,this.segundos);
        this.h2.setHours(this.horaIni,this.minutoIni,this.segundoIni);
        this.h1.setHours(this.h1.getHours() - this.h2.getHours(), this.h1.getMinutes() - this.h2.getMinutes(), this.h1.getSeconds() - this.h2.getSeconds());
        return this.h1.getHours() + ":" + this.h1.getMinutes() + ":" + this.h1.getSeconds();
      },
      EstaTrabajando(){
        return this.trabajando;
      },
      getEsTiempo(){
        this.h1.setHours(this.hora,this.minutos,this.segundos);
        this.h2.setHours(this.horaIni,this.minutoIni,this.segundoIni);
        this.h1.setHours(this.h1.getHours() - this.h2.getHours(), this.h1.getMinutes() - this.h2.getMinutes(), this.h1.getSeconds() - this.h2.getSeconds());
        if(this.h1.getMinutes()<5){
          return true;
        }
        else{
          return false;
        }
      },

    }
  }
</script>
<style>
</style>
