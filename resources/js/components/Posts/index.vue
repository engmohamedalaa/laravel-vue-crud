<template>
  <div class="col-12">
    <div class="row">
        <div class="col-6">
            <select v-model="category_id" class="form-control">
                <option value="">--Choose Category--</option>
                <option v-for="category in categories" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>
        <div class="col-6">
            <input v-model="title_search" type="text" class="form-control" placeholder="Search For Title">
        </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">
            <a href="#" @click.prevent="change_sort('id')">id</a>
            <span :class="this.sort_field === 'id' && this.sort_direction === 'asc' ? 'text-dark' : 'text-secondary'">&uarr;</span>
            <span :class="this.sort_field === 'id' && this.sort_direction === 'desc' ? 'text-dark' : 'text-secondary'">&darr;</span>
          </th>
          <th scope="col">
            <a href="#" @click.prevent="change_sort('title')">title</a>
            <span :class="this.sort_field === 'title' && this.sort_direction === 'asc' ? 'text-dark' : 'text-secondary'">&uarr;</span>
            <span :class="this.sort_field === 'title' && this.sort_direction === 'desc' ? 'text-dark' : 'text-secondary'">&darr;</span>
          </th>
          <th scope="col">
            <a href="#" @click.prevent="change_sort('body')">body</a>
            <span :class="this.sort_field === 'body' && this.sort_direction === 'asc' ? 'text-dark' : 'text-secondary'">&uarr;</span>
            <span :class="this.sort_field === 'body' && this.sort_direction === 'desc' ? 'text-dark' : 'text-secondary'">&darr;</span>
          </th>
          <th scope="col">
            <a href="#" @click.prevent="change_sort('created_at')">created_at</a>
            <span :class="this.sort_field === 'created_at' && this.sort_direction === 'asc' ? 'text-dark' : 'text-secondary'">&uarr;</span>
            <span :class="this.sort_field === 'created_at' && this.sort_direction === 'desc' ? 'text-dark' : 'text-secondary'">&darr;</span>
          </th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts.data" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.body.substring(0,30) }}</td>
          <td>{{ post.created_at }}</td>
          <td>
          <router-link :to="{ name:'posts.edit', params:{ id:post.id} }" class="btn btn-success">Edit</router-link>
          <button @click="delete_post(post.id)" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <pagination :data="posts" @pagination-change-page="getResults"></pagination>
  </div>
</template>

<script>
export default {
    data(){
        return {
          posts:{},
          categories:{},
          category_id:'',
          sort_field:'created_at',
          sort_direction:'DESC',
          title_search:'',
        }
    },
    mounted() {
    axios.get('/api/categories')
          .then(response => {
              this.categories = response.data.data;
          });
      this.getResults();
    },
    methods:{
      change_sort(field){
        if(this.sort_field === field){
            this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc';
        }else {
            this.sort_field = field;
            this.sort_direction='asc';
        }
        this.getResults();
      },
      getResults(page = 1) {
          axios.get('/api/posts?page=' + page
              + '&category_id=' + this.category_id
              + '&sort_field=' + this.sort_field
              + '&sort_direction=' + this.sort_direction
              + '&title_search=' + this.title_search)
              .then(response => {
                  this.posts = response.data;
              });
      },
      delete_post(id) {
        swal({
            title: "هل انت متأكد من الحذف؟",
            icon: "warning",
            buttons: ["لا", "نعم"],
            dangerMode: true,
        })
          .then((willDelete) => {
              if (willDelete) {
                  axios.delete('/api/posts/' + id).then(response => {
                      swal("تم الحذف بنجاح");
                      this.getResults()
                  })
              } else {
                  swal("عفوا يوجد مشكلة!");
              }
          }).catch(error => {
          swal({
              icon: 'error',
              title: 'يوجد خطأ ما!'
          });
        });
      }
    },
    watch:{
      category_id(value){
        this.getResults()
      },
      title_search(){
        this.getResults();
      }
    },
}
</script>
