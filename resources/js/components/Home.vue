<template>
  <div>
    
  <nav class="panel column is-offset-2 is-8" >
    <p class="panel-heading">
      Vuejs Phonebook 
      <button class="button is-primary is-outlined" @click="openAdd">
        Add New
      </button>
      <!-- used here loading icon -->
      <span class="is-pulled-right" v-if="!loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
      </span>
    </p>
    <div class="panel-block">
      <p class="control has-icons-left">
        <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
        <span class="icon is-small is-left">
          <i class="fa fa-search"></i>
        </span>
      </p>
    </div>
   
   
    <a class="panel-block " v-for="item,key in temp">
      <span class="column is-9">
        {{ item.name }}
      </span>
      <span class="panel-icon column is-1">
        <i class="has-text-danger fa fa-trash" aria-hidden="true" @click="del(key,item.id)"></i>
        <!-- we have to use del because delete key word is reserved in vue-->
      </span>
      <span class="panel-icon column is-1">
        <i class="has-text-info fa fa-edit" aria-hidden="true" @click="openUpdate(key)"></i>
      </span><span class="panel-icon column is-1">
        <i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
      </span>
    </a>
  </nav>

  <!-- props -->

  <Add :openmodal='addActive' @closeRequest='close'></Add>
  <Show :openmodal='showActive' @closeRequest='close'></Show>
  <Update :openmodal='updateActive' @closeRequest='close'></Update>
  </div>
</template>

<script>
// component
let Add = require('./Add.vue').default;
let Show = require('./Show.vue').default;
let Update = require('./Update.vue').default;
  export default{
    components:{Add,Show,Update},
    data(){
      return{
        addActive : '',
        showActive : '',
        updateActive : '',
        lists:{},
        errors:{},
        loading:false,
        searchQuery:'',
        temp:''
      }
    },
    watch:{
      searchQuery(){
        if (this.searchQuery.length > 0) {
          //filter function creates an array according to function 
          this.temp = this.lists.filter((item) => {
            // when we search the data that time we have to show the other data also when we back, for this reason we used temp here 
            // we search by any field for this reason we used some here
            return Object.keys(item).some((key)=>{
              let string = String(item[key]) 
              // if the search query match with this then return otherwise not return
              return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
              // console.log(string)
            })
          });
          // console.log(result)
        }else{
          // if there are no search result, that time we have to populate all the data of our list.
          this.temp = this.lists
        }
      }
    },
    mounted(){
      // we also used created method instead of mounted
      axios.post('/getData')
      .then((response)=> this.lists = this.temp = response.data)
      .catch((error) => this.errors = error.response.data.errors)
    },
    methods:{
      openAdd(){
        this.addActive = 'is-active';
      },
      openShow(key){
        // children 1 means show component
        this.$children[1].list = this.temp[key]
        this.showActive = 'is-active';
      },
      openUpdate(key){
        // children 2 is update component
        this.$children[2].list = this.temp[key]
        this.updateActive = 'is-active';
      },
      close(){
        this.addActive = this.showActive = this.updateActive = ''
      },
      del(key,id){
        if (confirm("Are you sure ?")) {
          // at first show the confirm message then 
          // loading ta delete er samoi show korbe and jakhon delete hoye jabe tkn r dekha be na that means false hoye jabe
          this.loading = true
          //!this.loading
          // we have to be used delete method here instead of post.To check that type route:list
          // we just delete the particular item only.For this we used key and 1 for only 1 item
          // here key is the index and id is the item id
          axios.delete(`/phonebook/${id}`)
          .then((response)=> {this.lists.splice(key,1);this.loading = !this.loading})
          .catch((error) => this.errors = error.response.data.errors) 
        }
        console.log(`${key} ${id}`)
      }
    }
  }
</script>
