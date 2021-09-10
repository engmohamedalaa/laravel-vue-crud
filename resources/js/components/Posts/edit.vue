<template>
    <div>
        <form @submit.prevent="submit_form">
            Post Title:<br/>
            <input type="text" v-model="fields.title" class="form-control"><br/>
            <div class="alert alert-danger" v-if="errors && errors.title">
                {{ errors.title[0]}}
            </div>
            Post Text:<br/>
            <textarea rows="10" v-model="fields.body" class="form-control"></textarea><br/>
            <div class="alert alert-danger" v-if="errors && errors.body">
                {{ errors.body[0]}}
            </div>
            Category:<br/>
            <select class="form-control" v-model="fields.category_id">
                <option value="">==Please Choose Categories ==</option>
                <option v-for="category in categories" :value="category.id">{{ category.name}}</option>
            </select>
            <div class="alert alert-danger" v-if="errors && errors.category_id">
                {{ errors.category_id[0]}}
            </div>
            <br/>
            <input
                type="submit"
                :disabled="form_submiting"
                :value="form_submiting ? 'Saving Post...' : 'Save'"
                class="btn btn-primary"/>
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
            },
            errors:{},
            form_submiting:false
        }
    },
    mounted() {
        axios.get('/api/categories')
            .then(response => {
                this.categories = response.data.data;
            });
        axios.get('/api/posts/'+this.$route.params.id)
            .then(response => {
                this.fields = response.data.data;
            });
    },
    methods:{
        submit_form(){
            this.form_submiting=true;
            axios.put('/api/posts/'+this.$route.params.id,this.fields)
                .then(response =>  {
                    swal({
                        title:"تم التعديل بنجاح",
                        icon: "success",
                        button: "إغلاق",
                    })
                    this.$router.push('/app');
                    this.form_submiting = false;
                }).catch(error=>{
                if(error.response.status === 422){
                    swal({
                        title:"عفوا يوجد مشكلة!",
                        icon: "error",
                        button: "إغلاق",
                    })
                    this.errors = error.response.data.errors;
                    this.form_submiting=false;
                }
            });
        }
    }
}
</script>
