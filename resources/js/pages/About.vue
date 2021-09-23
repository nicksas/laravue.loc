<template>

    <div>
    <h1>likes {{likes}}</h1>
    </div>
</template>

<script>
import CreatePost from "../components/CreatePost";
export default {
    components: {CreatePost},
    data(){
        return {
            likes: 0
        }
    }
}
</script>

<style scoped>

</style>
