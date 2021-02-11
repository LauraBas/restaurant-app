class ApiClient {
    static getDishApi() {
        return axios.get(`http://127.0.0.1:8001/api/dishes`);        
    };
    static deleteDishApi(id) {
        return  axios.delete(`http://127.0.0.1:8001/api/dishes/${id}`);        
    };
    static storeDishApi(dish) {
       return axios.post(`http://127.0.0.1:8001/api/dishes`, dish);
       
    };
    static updateDishApi(id) {
        axios.patch(`http://127.0.0.1:8001/api/dishes/${id}`);            
    };
}
export default ApiClient;