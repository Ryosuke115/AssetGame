<template>
<div>
 <select id="asset_select" name="asset_select" v-model="selected">
 <option v-for="asset in assets">{{ asset.asset_name }}</option>
 </select><br>
 <span>{{ selected }}</span>
 <p style="color: red">{{ asset_data[0] }}</p>
 <p>{{ asset_data[1] }}</p>
<button type="button" @click="selectAs">じっこうする</button>
 
</div>

</template>


<script>
 export default {
   data:function() {
     return {
       assets: [],
       selected: '',
       asset_data: ''
       
     }
   },
   methods: {
     getAssets() {
       axios.get('/api/assets', {
          params: {
            id: '1'
          }
       }).then(response => {
          this.assets = response.data
          console.log(response.data)
          
       }).catch(response => {
           console.log("error")
       });
     },
     
     selectAs() {
       axios.post('/api/select', {
          title: this.selected
       }).then((response) => {
          this.asset_data = response.data
          this.selected = ''
       })
     }
     
     
   },
   mounted() {
     this.getAssets();
   }
 }
</script>