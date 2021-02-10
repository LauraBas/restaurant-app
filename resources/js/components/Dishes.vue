<template>
    <div class="container">
        <div>
        <h3 class="text-center">All Dishes</h3><br/>
    
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>  
                <th colspan='2'>Actions</th>        
            </tr>
            </thead>
            <tbody>
            <tr v-for="dish in dishes.data" :key="dish.id">
            <th scope="row">{{dish.id}}</th>
                <td>{{dish.title}}</td>
                <td>{{dish.description}}</td>
                <td>{{dish.price}}</td>
                <td>
                    <button class="btn btn-info">edit</button>
                </td>
                <td>
                    <button @click="deleteDish(dish.id)"class="btn btn-danger">delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</template>

<script>

    export default {
        data() {
           return {
                dishes: [],
            }
        },
        created(){
            this.getDishes()        
        },  
    methods: {
        async getDishes(){
            const res = await axios.get(`http://127.0.0.1:8001/api/dishes`)
            this.dishes = res.data;   
        },
        async deleteDish(id){
            const res = await axios.delete(`http://127.0.0.1:8001/api/dishes/${id}`)
            this.getDishes();
        },  
    }
}
</script>
