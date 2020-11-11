<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Control de trabajo</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" @click.prevent="generarReporte"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</button>
          </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="{name: 'control.crear', params:{id: fillCrearActividad.nIdUsuario}}">
              <i class="fas fa-arrow-left">Regresar</i>
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card card-header" style="background-color: #A10328;">
                <h3 class="card-tittle">Lista de actividades</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row" >
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
                          <el-select v-model="fillCrearActividad.nIdFuncion" placeholder="Seleccione la función" :readonly="trabajando" clearable>
                            <el-option
                              v-for="(item, index) in listFuncionesByUsuario" :key="index"
                              :label="item.code_name"
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
                        <label class="col-md-3 col-form-label">Tiempo fin</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="terActi" readonly="readonly">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
      data() {
        return {
          fillListarActividad:{
            nIdUsuario: this.$attrs.id,
            nIdFuncion: ''
          },
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
          listFuncionesByUsuario: []
        }
    },
    methods: {
      generarReporte(){
        var ruta = '/administracion/actividades/postListarActividades'
        axios.post(ruta,{
          params:{
            'nIdUsuario'  : this.fillCrearActividad.nIdUsuario
          }
        }).then(response => {
          this.listFuncionesByUsuario = response.data;
        })
      },
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getListarActividades(){
        var ruta = '/administracion/actividades/getListarActividades'
        axios.get(ruta,{
          params:{
            'nIdUsuario'  : this.fillCrearActividad.nIdUsuario
          }
        }).then(response => {
          this.listFuncionesByUsuario = response.data;
        })
      },
    },
  }
</script>
<style>
</style>
