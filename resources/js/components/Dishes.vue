<template>
    <div class="container">
        <div>
            <h3 class="text-center">All Dishes</h3>
            <br />
            <button @click="openModal();"class=" my-4 btn btn-warning">
                Add
            </button>
            <!-- The Modal -->
            <div class="modal" :class="{ show: modal }">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Create</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="my-4">
                                    <label for="nombre">Title</label>
                                    <input
                                        v-model="dish.title"
                                        type="text"
                                        class="form-control"
                                        id="title"
                                    />
                                </div>
                                <div class="my-4">
                                    <label for="description">description</label>
                                    <input
                                        v-model="dish.description"
                                        type="text"
                                        class="form-control"
                                        id="description"
                                    />
                                </div>
                                <div class="my-4">
                                    <label for="price">price</label>
                                    <input
                                        v-model="dish.price"
                                        type="number"
                                        min=0
                                        class="form-control"
                                        id="price"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button
                                class="btn btn-warning"
                                data-dismiss="modal"
                                @click="closeModal()"
                            >
                                cancel
                            </button>
                            <button
                                class="btn btn-success"
                                data-dismiss="modal"
                                @click="storeDish()"
                            >
                                save
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dish in dishes.data" :key="dish.id">
                        <th scope="row">{{ dish.id }}</th>
                        <td>{{ dish.title }}</td>
                        <td>{{ dish.description }}</td>
                        <td>{{ dish.price }}</td>
                        <td>
                            <button class="btn btn-info">
                                edit
                            </button>
                        </td>
                        <td>
                            <button
                                @click="deleteDish(dish.id)"
                                class="btn btn-danger"
                            >
                                delete
                            </button>
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
            modal: 0,           
            dish: {
                title:'',
                description:'',
                price: 0,
            },
        };
    },
    created() {
        this.getDishes();
    },
    methods: {
        async getDishes() {
            const res = await axios.get(`http://127.0.0.1:8001/api/dishes`);
            this.dishes = res.data;
        },
        async deleteDish(id) {
            const res = await axios.delete(`http://127.0.0.1:8001/api/dishes/${id}`);
            this.getDishes();
        },
        async storeDish() {
            const res = await axios.post(`http://127.0.0.1:8001/api/dishes`, this.dish);
            this.closeModal();
            this.getDishes();
        },
        openModal() {  
            this.modal = 1;          
            this.id = 0;
            this.dish.title = "";
            this.dish.description = "";
            this.dish.price = 0;        
        },
        closeModal() {
            this.modal = 0;
        }
    }
};
</script>
<style>
.show {
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
}
</style>
