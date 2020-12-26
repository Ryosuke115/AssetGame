 <template>
 <div>
  <tr v-for="task in tasks">
     <th>{{ task.id }}</th>
     <td>{{ task.name }}</td>
   </tr>
   
   
   <select id="select" name="select" v-model="select">
    <option value=0>買い</option>
    <option value=1>売り</option>
    </select>
<p>{{ select }}</p>
<p v-show="select == 0">おいおい</p>
<p v-show="select == 1">ドラクエ</p>
 </div>
</template>
 <script>
     export default {
      data:function() {
        return {
          tasks: [],
          select: ''
        }
      },
      methods: {
         getTasks() {
           axios.get('/api/tasks', {
              params: {
                 id: '1'
              }
            })
                .then(response => {
                    this.tasks = response.data
                    console.log(response)
                })
                .catch(response => {
                  console.log(response)
                });
         }
      },
     mounted() {
       this.getTasks();
     }
     
     }
 </script>