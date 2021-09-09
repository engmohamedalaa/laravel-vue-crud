<template>
  <div>
    <select v-model="category_id" class="form-control">
        <option value="">--Choose Category--</option>
        <option v-for="category in categories" :value="category.id">
            {{ category.name}}
        </option>
    </select>
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
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts.data" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.body.substring(0,30) }}</td>
          <td>{{ post.created_at }}</td>
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
          + '&category_id='+this.category_id
          + '&sort_field='+this.sort_field
          + '&sort_direction='+this.sort_direction)
          .then(response => {
              this.posts = response.data;
          });
      }
    },
    watch:{
      category_id(value){
        this.getResults()
      }
    },
}
</script>
