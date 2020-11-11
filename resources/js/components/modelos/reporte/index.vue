<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Funciones</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template v-if="listRolPermisosByUsuario.includes('funciones.crear')">
              <router-link class="btn btn-info btn-sm" :to="{name: 'funciones.crear'}">
                <i class="fas fa-plus-square">Nueva función</i>
              </router-link>
            </template>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card card-header" style="background-color: #A10328;">
                <h3 class="card-tittle">Criterios de búsqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqFunciones.cNombre" @keyup.enter="getListarFunciones">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Código de función</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqFunciones.cFuncion_Code" @keyup.enter="getListarFunciones">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarFunciones" v-loading.fullscreen.lock="fullscreenLoading">Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterioBsq">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header" style="background-color: #A10328;">
                <div class="card-tittle" >
                  <h3>Bandeja de resultados</h3>
                </div>
              </div>
              <div class="card-body table-responsive">
                <template v-if="listarFuncionesPaginated.length">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Código de función</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarFuncionesPaginated" :key="index">
                        <td v-text="item.name"></td>
                        <td v-text="item.code_name"></td>
                        <td>
                        <template v-if="listRolPermisosByUsuario.includes('funciones.editar')">
                          <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'funciones.editar', params:{id: item.id}}">
                            <i class="fas fa-pencil-alt"></i>Editar
                          </router-link>
                        </template>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item" v-if="pageNumber >0">
                        <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                      </li>
                      <li class="page-item" v-for="(page, index) in pageList" :key="index" :class="[page == pageNumber ? 'active' : '']">
                        <a href="#" class="page-link" @click.prevent="selectPage(page)">{{page+1}}</a>
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount -1">
                        <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
                      </li>
                    </ul>
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
</template>

<script>
  export default{
    data(){
      return{
        fillBsqFunciones:{
          cNombre: '',
          cFuncion_Code: ''
        },
        listFunciones: [],
        listRolPermisosByUsuario: JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario')),
        fullscreenLoading: false,
        pageNumber: 0,
        perPage: 5
      }
    },
    computed:{
      pageCount(){
        let a = this.listFunciones.length,
            b = this.perPage;
        return Math.ceil(a/b);
      },
      listarFuncionesPaginated(){
        let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;
        return this.listFunciones.slice(inicio,fin);
      },
      pageList(){
        let a = this.listFunciones.length,
            b = this.perPage;
        let pageCount = Math.ceil(a/b);
        let count  = 0, pagesArray = [];
        while(count < pageCount){
          pagesArray.push(count);
          count++;
        }
        return pagesArray;
      }
    },
    methods:{
      limpiarCriterioBsq(){
        this.fillBsqFunciones.cNombre = '';
        this.fillBsqFunciones.cFuncion_Code = '';
      },
      limpiarBandejaUsuarios(){
        this.listFunciones = [];
      },
      getListarFunciones(){
        this.fullscreenLoading = true;
        var url = '/administracion/funciones/getListarFunciones'
        axios.get(url, {
          params:{
            'cNombre' : this.fillBsqFunciones.cNombre,
            'cFuncion_Code' : this.fillBsqFunciones.cFuncion_Code
          }
        }).then(response => {
          this.inicializarPaginacion();
          this.listFunciones = response.data;
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
      nextPage(){
        this.pageNumber++;
      },
      prevPage(){
        this.pageNumber--;
      },
      selectPage(page){
        this.pageNumber = page;
      },
      inicializarPaginacion(){
        this.pageNumber = 0;
      }
    }
  }
</script>
<style>
</style>
