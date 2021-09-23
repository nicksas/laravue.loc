<template>
    <div class="container">
        <h1>{{$route.params.id}}</h1>
        <div v-if="postId.length < 0">

        <input v-model="post.title" type="text">
        <input v-model="post.body" type="text">
        {{ this.postId = $route.params.id}}
        </div>
        <div v-else-if="postId === 0">
            Загрузка поста
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data(){
        return{
            postId: ''

        }
    },
    methods: {
        async getPost(){
            const response = axios.get(`api/posts/19`)
            console.log(response)
        }
    },
    mounted() {
        this.getPost()
    }

}
</script>

<style scoped>

</style>
