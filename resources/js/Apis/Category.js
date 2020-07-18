import Api from './Api';
var config = {
    headers: {'Access-Control-Allow-Origin': '*'}
};
export default {
    allcategorys(){
        return Api.get("categorys");
    },
    destroy(id){
        return Api.delete("categorys/destroy/"+id);
    },
    addCategory(category){
        return Api.post("categorys",category);
    }
}