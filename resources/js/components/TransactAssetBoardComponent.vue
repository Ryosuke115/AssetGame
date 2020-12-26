<template>
 <div>
   
<a href="/asset/invest">おす</a>


<p>ここでは資産の市場状況を確認できます</p>
<p>確認したい資産を選択</p>
<form>
<select id="asset_select" name="asset_select" v-model="selected">
 <option v-for="asset in assets">{{ asset.asset_name }}</option>
</select>
</form>
<button type="button" @click="showMarket">市況確認</button>



<div @drop="dropList($event, asset_status[0])">
<p draggable @dragstart="dragList($event, asset_status[0])">名前<br>{{ asset_status[0] }}</p></div>
<p>今期のコイン受付額<br>{{ asset_status[1] }}</p>
<p>高値<br>{{ asset_status[2] }}</p>
<p>安値<br>{{ asset_status[3] }}</p>

<h4 @drop="dropList($event, asset_status[0])"
    @dragover.prevent
    @dragenter.prevent
     >ドロップリスト
<p v-for="list in detroit">
 <br>{{ list }}
 </p>
 </h4>
</div>
</template>
<script>
export default {
   data:function() {
     return {
       selected: '',
       assets: [],
       asset_select: '',
       asset_status: '',
       lists: [],
       detroit: []
     }
   },
   
   methods: {
      testOrder() {
         axios.get('/api/markets', {
         params: {
            id: '1'
          }
         }).then(response => {
            this.assets = response.data
            console.log(response.data)
         }).catch(reponse => {
            console.log('error')
         });
      },
      
      showMarket() {
        axios.post('/api/markets/select', {
               asset_select: this.selected
        }).then((response) => {
            this.asset_status = response.data
            this.lists = response.data
        })
      },
      
      dragList(event, dragId) {
       console.log(dragId)
       event.dataTransfer.effectAllowed = 'move'
       event.dataTransfer.dropEffect = 'move'
       event.dataTransfer.setData('name', dragId)
      },
      dropList(event, dropName) {
        const dragName = event.dataTransfer.getData('name')
        this.detroit.push(dropName)
      }
        
   },
   computed: {
      CategoryA () {
          return this.lists.filter(list => list.catgory == 'A')
      }
   },
   mounted() {
     this.testOrder();
   }
}
</script>