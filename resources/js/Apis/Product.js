import Api from './Api';
var config = {
    headers: {'Access-Control-Allow-Origin': '*'}
};
export default {
    allproducts(){
        return Api.get("products");
    },
    getProductsByCategory(category,orderby){
        return Api.get("products/filter", {
                    params: {
                        category: category,
                        orderby:orderby
                    }
                });
    },
    addProduct(product){
        return Api.post("products",product);
    },
    destroy(id){
        return Api.delete("products/destroy/"+id);
    },
}