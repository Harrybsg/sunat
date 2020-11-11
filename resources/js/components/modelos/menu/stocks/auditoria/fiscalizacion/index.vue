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
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <tfoot>
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
                    </tfoot>
                    <tbody >
                      <tr v-for="i in info">
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
                </div>

                <!--<template v-if="listarUsuariosPaginated.length">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Fotografía</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Usercode</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarUsuariosPaginated" :key="index">
                        <td>
                          <template v-if="!item.profile_image">
                            <li class="user-block">
                              <img src="/img/avatar.png" class="profile-avatar-img img-fluid img-circle">
                            </li>
                          </template>
                          <template v-else>
                            <li class="user-block">
                              <img :src="item.profile_image" class="profile-avatar-img img-fluid img-circle">
                            </li>
                          </template>
                        </td>
                        <td v-text="item.fullname"></td>
                        <td v-text="item.email"></td>
                        <td v-text="item.user_code"></td>
                        <td v-text="item.username"></td>
                        <td>
                          <template v-if="item.state == 'A'">
                            <span class="badge badge-succes" v-text="item.state_alias"></span>
                          </template>
                          <template v-else>
                            <span class="badge badge-succes" v-text="item.state_alias"></span>
                          </template>
                        </td>
                        <td>
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'usuario.ver', params:{id: item.id}}">
                            <i class="fas fa-folder"></i>Ver
                          </router-link>
                          <template v-if="item.state == 'A'">
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'usuario.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i>Editar
                            </router-link>
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'usuario.funciones', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i>Funciones
                            </router-link>
                            <router-link class="btn btn-flat btn-success btn-sm" :to="{name:'usuario.permiso', params:{id: item.id}}">
                              <i class="fas fa-key"></i>Permiso
                            </router-link>
                            <button class="btn btn-flat btn-danger btn-sm" @click.prevent="setCambiarEstadoUser(1,item.id)">
                              <i class="fas fa-trash"></i>Desactivar
                            </button>
                          </template>
                          <template v-else>
                            <button class="btn btn-flat btn-success btn-sm" @click.prevent="setCambiarEstadoUser(2, item.id)">
                              <i class="fas fa-check"></i>Activar
                            </button>
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
                </template>-->
                <!--<template v-else>
                  <div class="callout callout-info">
                    <h5>No se encontraron registros...</h5>
                  </div>
                </template>-->
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
      .get('/json/data.json')
      .then(response => {
        console.log(response);
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
