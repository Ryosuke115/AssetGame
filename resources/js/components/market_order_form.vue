<template>
<div>
<select id="select" name="buy_sell" v-model="select">
<option value=0>買い</option>
<option value=1>売り</option>
<option value=2>成行買い</option>
</select>

<p v-show="select == 0||select == 1"><input type="number" name="transaction">数量選択</p>
</div>
</template>
<script>
 export default {
   data:function() {
     return {
        select: ''
     }
   }
 }
</script>