<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Control de la Deuda y Cobranza</h1>
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
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Opción 1</th>
                        <th>Opción 2</th>
                        <th>Opción 3</th>
                        <th>OPción 4</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Opción 1</th>
                        <th>Opción 2</th>
                        <th>Opción 3</th>
                        <th>Opción 4</th>
                      </tr>
                    </tfoot>
                    <tbody >
                      <tr v-for="i in info">
                        <td>{{i.userId}}</td>
                        <td>{{i.id}}</td>
                        <td>{{i.title}}</td>
                        <td>{{i.completed}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
        errored: false
      }
    },
    computed:{

    },
    methods:{

    },
    mounted(){
      axios
      .get('https://jsonplaceholder.typicode.com/todos')
      .then(response => {
        this.info = response.data
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
