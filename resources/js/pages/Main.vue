<template>
    <create-post
    @create="createPost"
    ></create-post>
            <div class="container">
                <div class="row">
                    <div v-if="cards.length !== 0">
                        <h1>Список пользователей</h1>
                        <div  class="card-list" >
                            <div class="card" style="width: 18rem;" v-for="card in cards" :key="card.id" :id="card.id"  >
                                <img src="https://www.ejin.ru/wp-content/uploads/2018/10/crew4_1024.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                                                    <h5 class="card-title card-title--username">{{ card.title }}</h5>
                                                                    <h5 class="card-title">{{ card.body }}</h5>
                                    <p class="card-text">email</p>
                                    <button type="button" @click="removeCard(card)" class="btn btn-secondary">Удалить</button>
                                    <a href="#" class="btn btn-primary" @click="()=>{getUser(card)}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Смотреть профиль</a>
                                    <div class="api btn btn-success"
                                    @click="$router.push(`/posts/${card.id}`)"
                                    >Изменить</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="nothing" v-else-if="cards.length === 0">Список пользователей пуст</h1>
                </div>
            </div>

    <modal-card v-model:show="isModalOpened" @remove="removeCard" :card="card">
    </modal-card>

</template>

<script>
import axios from 'axios'
import CreatePost from "../components/CreatePost";
import ModalCard from "../components/ModalCard";
export default {
    components:
        {
            CreatePost,
            ModalCard,
        },
    data() {
        return {
            cards: [],
            card: [],
            isModalOpened: false
        }
    },
    methods: {
      async  createPost(post){
            try{
                const response = await axios.post('api/posts', {
                    title: post.title,
                    body: post.body
                });
                console.log(response)

                    this.cards.push(post)
            }catch (e){
                alert('Ошибка')
            }

            console.log(this.cards)
        }
        ,
        async fetchUsers(){
            try {
                const response = await axios.get('api/posts');
                // console.log(response)

                this.cards = response.data
            } catch (e){
                alert('Ошибка')
            }
        },

        async removeCard(card){
            console.log(card.id)
            this.isModalOpened = false
            try {
                const response = await axios.delete('api/posts/' + card.id)
                let penis = response.data
                console.log(penis)
                if (response.data.status === true){
                    this.cards = this.cards.filter(item => card.id !== item.id)
                }
            } catch (e){
                console.log(e)
                console.log('ошибка')
            }

        },
        getUser(event){
            // console.log(event.address.street)
            this.card = event;

            this.isModalOpened = true;
            // var myModal = document.getElementById('staticBackdrop')
            //
            // myModal.show()

            // document.querySelector('#staticBackdrop').show()
            // console.log(this.card)
            // console.log(this.card.address)
        }
    },
    mounted() {
        this.fetchUsers();
    }
}
</script>

<style scoped>
.btn-success{
    margin-top: 20px;
    width: 100%;
}
.card{
    min-width: 270px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card-title--username{
    color: red;
    font-weight: 600;
    margin-bottom: 15px;
}
.card-text{
    margin-bottom: 25px;
}
.card-body{
    padding-bottom: 30px;
    padding-top: 25px;
}
.card-list{
    display: flex;
    flex-wrap: wrap;
    row-gap: 20px;
}
.card-title:first-of-type{
    margin-right: 10px;
}
</style>
