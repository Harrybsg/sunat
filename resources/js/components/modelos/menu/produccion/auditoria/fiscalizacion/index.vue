<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Fiscalización</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header" style="background-color: #A10328;">
                <div class="card-tittle">
                  <h3>Bandeja de resultados</h3>
                </div>
              </div>
              <div class="card-body table-responsive">
                  <template v-if="listarDatosPaginated.length">
                    <table class="table table-hover table-head-fixed text-nowrap projects">
                      <thead>
                        <tr>
                          <th>DEP</th>
                          <th>DES_RES</th>
                          <th>CANT</th>
                          <th>COD_DEP</th>
                          <th>COD_ARE_ACO</th>
                          <th>PER_GEN</th>
                          <th>NOMIND</th>
                          <th>COD_USUARIO</th>

                        </tr>
                      </thead>
                      <tbody >
                        <tr v-for="i in listarDatosPaginated">
                          <td>{{i.DEP}}</td>
                          <td>{{i.DES_RES}}</td>
                          <td>{{i.CANT}}</td>
                          <td>{{i.COD_DEP}}</td>
                          <td>{{i.COD_ARE_ACO}}</td>
                          <td>{{i.PER_GEN}}</td>
                          <td>{{i.NOMIND}}</td>
                          <td>{{i.COD_USUARIO}}</td>
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
      return {
        info: null,
        loading: true,
        errored: false,
        pageNumber: 0,
        perPage: 5,
        listDatos: []
      }
    },
    computed:{
      pageCount(){
        let a = this.listDatos.length,
            b = this.perPage;
        return Math.ceil(a/b);
      },
      listarDatosPaginated(){
        let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;

        return this.listDatos.slice(inicio,fin);
      },
      pageList(){
        let a = this.listDatos.length,
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
      inicializarPaginacion(){
        this.pageNumber = 0;
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
    },
    mounted(){
      axios
      .get('/json/data.json')
      .then(response => {
        this.inicializarPaginacion();
        this.info = response.data
        this.listDatos = response.data
      })
      .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false)
    }

  }
</script>
<style>
</style>
