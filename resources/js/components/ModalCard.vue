<template>
  <div v-if="show"  class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <slot name="username">
              {{card.title}}
            </slot>
          </h5>
          <button @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="https://www.ejin.ru/wp-content/uploads/2018/10/crew4_1024.png" alt="" class="modal-body__img">
          <div class="modal-body__wrap">
            <div class="modal-body--text modal-body--text--name">
              <slot name="fullName">
                {{card.body}}
              </slot>
            </div>
            <div class="modal-body--text">
              <slot name="city">
                Gwenborough
              </slot>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="api btn btn-success">123</div>

          <button type="button" @click="removeCard" data-bs-dismiss="modal" class="btn btn-secondary">Удалить</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
          @click="closeModal"
          >Закрыть</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // name: 'modal-card',
  // data(){
  //   return {
  //   }
  // },
  props:{
    card: {
      type: Object,
      default: () => {}
    },
    show: {
      type: Boolean,
      default: false
    }
  },
  methods:{
    closeModal(){
      this.$emit('show', false)
    },
    removeCard(){
      this.closeModal()
      this.$emit('remove', this.card)
    },
  },
  // mounted() {
  //   // console.log(this.card)
  // },
  updated() {
    // console.log(this.card)
  }
}
</script>

<style scoped>
.modal-body__img{
  width: 200px;
}
.modal-body--text{
  font-size: 18px;
  color: black;
  margin-bottom: 6px;
}
.modal-body--text--phrase{
  font-size: 16px;
  text-decoration: underline;
}
.modal-body--text--name{
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 20px;
}
.modal-body{
  display: flex;
  column-gap: 30px;
}
.btn{
  width: 100%;
}
</style>
