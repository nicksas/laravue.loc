<template>
    <div class="container">
        <create-post  @create="createPost"></create-post>
        <h1>{{$route.params.id}}</h1>
<!--        <div v-if="postItem.length < 0">-->

        <input v-model="postItem.title" type="text">
        <input v-model="postItem.body" type="text">
        <button @click="createPost" class="btn btn-success">отправить</button>
<!--        {{ this.postId = $route.params.id}}-->
        </div>
<!--        <div v-else-if="postItem === 0">-->
<!--            Загрузка поста-->
<!--        </div>-->
<!--    </div>-->
</template>

<script>
import axios from "axios";
import CreatePost from "../components/CreatePost";
axios.defaults.baseURL = 'http://laravue.loc/'

export default {
    components: {CreatePost},
    data(){
        return{
            postItem: {
                title: '1',
                body: '2'
            }

        }
    },
    methods: {
        async getPost(){
            const response = await axios.get(`api/posts/`+ this.$route.params.id)
            this.postItem = response.data
            this.postItem.body = response.data.body
            this.postItem.title = response.data.title
            console.log(this.postItem.title)
        },
        async  createPost(){
            try{
                const response = await axios.put('api/posts/' + this.$route.params.id, {
                    title: this.postItem.title,
                    body: this.postItem.body
                });


            }catch (e){
                console.log(e)
                alert('Ошибка')
            }

            console.log(this.cards)
        }
    },
    mounted() {
        this.getPost()
    }

}
</script>

<style scoped>

</style>
