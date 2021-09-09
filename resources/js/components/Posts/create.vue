<template>
    <div>
        <form @submit.prevent="submit_form">
            Post Title:<br/>
            <input type="text" v-model="fields.title" class="form-control">
            <textarea rows="10" v-model="fields.body" class="form-control"></textarea>
            <select class="form-control" v-model="fields.category_id">
                <option value="">==Please Choose Categories ==</option>
                <option v-for="category in categories" :value="category.id">{{ category.name}}</option>
            </select>
            <br/>
            <button class="btn btn-primary">Save Post</button>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
          categories:{},
          fields:{
              title:'',
              text:'',
              category_id:''
          }
        }
    },
    mounted() {
        axios.get('/api/categories')
            .then(response => {
                this.categories = response.data.data;
            });
    },
    methods:{
    submit_form(){
        axios.post('/api/posts',this.fields)
          .then(response => {
              this.$router.push('/app');
          });
        }
    }
}
</script>
