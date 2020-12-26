<template>
  <div class="page-inner">
    <h2>Works</h2>
    <p>過去の制作事例の一部を紹介します。</p>
      <div class="item-list" v-for="item in items">
        <div class="card">
          <p  @click="openModal(item)" alt="Card image">こんちは</p>
        </div>
        <modal :val="postItem" v-show="showContent" @close="closeModal" />
      </div>
  </div>
</template>

<script>
  import modal from './Modal.vue'
  export default {
    components: {
      Modal: ''
    },
    data () {
      return {
        showContent: false,
        postItem: "",
        items: [
          { id: 1,
            desc: '課題で作成した美容室のHPです。',
            range: 'コーディング（レスポンシブ対応）',
            lang: 'HTML, CSS(Sass)',
          },
          { 
            id: 2, 
            desc: '実案件で作成したコーポレートサイトです。',
            range: 'コーディング（レスポンシブ対応）',
            lang: 'HTML, CSS(Sass)',
          },
          
        ]
      }
    },
    methods: {
       openModal(item) {
        this.showContent = true
        this.postItem = item
      },
      closeModal () {
        this.showContent = false
      }
    }
  }
</script>