<template>
<div>
<div style="display:grid; 
  grid-template-rows:50px 50px 50px 50px 70px 70px 80px 80px;
  grid-template-columns: 110px 110px 110px 110px 160px 160px 160px 160px;"
  >
  
  <h3 style="grid-row:1/2; grid-columns: 1/2;">資産板</h3>
  
<select id="asset_select" name="asset_select" v-model="selected" style="grid-row:3/4; grid-column:1/2;">
<option v-for="asset in assets">{{ asset.asset_name }}</option>
 </select><br>
 <p style="grid-row:2/3; grid-column:6/7;">{{ asset_data[2] }}</p>
 <p style="grid-row:3/4; grid-column:6/7;">最低購入単位<br>{{ asset_data[3] }}</p>
 <p style="color: red; grid-row:4/5; grid-column:6/7;">残りの未流出資産券数{{ asset_data[0] }}</p>
 <p style="grid-row:5/6; grid-column:6/7;">現在の投資受付額<br>{{ asset_data[1] }}</p>
 <p style="grid-row:6/7; grid-column:5/6;">資産券保有数の順位<br>{{ asset_data[5] }}  {{ asset_data[4] }}</p>
<button type="button" @click="selectAs" style="grid-row:4/5; grid-column:1/2;">状況閲覧</button>

</div>
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
          
       })
     }
     
     
   },
   mounted() {
     this.getAssets();
   }
 }
</script>