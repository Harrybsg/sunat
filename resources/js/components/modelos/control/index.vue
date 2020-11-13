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
            <router-link class="btn btn-info btn-sm" :to="{name: 'control.crear', params:{id: fillListarActividad.nIdUsuario}}">
              <i class="fas fa-arrow-left">Regresar</i>
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card card-header" style="background-color: #A10328;">
                <h3 class="card-title">Lista de actividades</h3>
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
                        <td>{{item.function_id}}</td>
                        <td>{{item.user_id}}</td>
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
          listActividadesUsuario: []
        }
    },
    mounted(){
      this.getListarActividades();
    },
    methods: {
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getListarActividades(){
        var ruta = '/administracion/actividades/getListarActividades'
        axios.get(ruta,{
          params:{
            'nIdUsuario'  : this.fillListarActividad.nIdUsuario
          }
        }).then(response => {
          console.log(response.data);
          this.listActividadesUsuario = response.data;
        })
      },
    },
  }
</script>
<style>
</style>
