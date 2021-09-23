<template>
    <div>
        <input v-model="post.title" type="text">
        <input v-model="post.body"  type="text">
        <button @click="createPost" class="btn btn-success" >Отправить</button>
    </div>
</template>

<script>
export default {
    name: 'create-post',
    data(){
        return {
            post: {
                title: '',
                body: ''
            }
        }
    },
    methods: {
        createPost(){
            this.post.id =  Date.now();
            this.$emit('create', this.post)
            this.post = {
                title: '',
                body: ''
            }
        }
    },
    mounted() {
        console.log(this.post)
    }
}
</script>

<style scoped>

</style>
