 <template>
 <div>
  <tr v-for="task in tasks">
     <th>{{ task.id }}</th>
     <td>{{ task.name }}</td>
     
   </tr>
 </div>
</template>
 <script>
     export default {
      data:function() {
        return {
          tasks: []
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