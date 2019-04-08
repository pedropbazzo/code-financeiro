export default {
    set(key, value){
        // window.localStorage.setItem(value);
        // return window.localStorage.getItem(value);
        window.localStorage[key] = value;
        return window.localStorage[key];
    },
    get(key, defalutValue = null){
        return window.localStorage[key] || defalutValue;
    },
    setObject(key, value){
        window.localStorage[key] = JSON.stringify(value);
        return this.getObject(key);
    },
    getObject(key){
        return JSON.parse(window.localStorage[key] || null)
    },
    remove(key){
        window.localStorage.removeItem(key);
    }
}