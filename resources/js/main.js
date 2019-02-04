window.Vue = require("vue");
import router from "./router";
import App from "./App";
import VeeValidate from "vee-validate";

require("./bootstrap");

const message = {
    custom: {
        name: {
            required:  "El campo nombre es requerido",
            alpha_spaces: "Solo letras y espacios"
        },

        identification_card: {

            required:  "El campo cedula es requerido",
            numeric: "Solo numeros"

        },

        gender: {

            required: "El campo genero es requerido"
        }
    }
};

Vue.use(VeeValidate);


const app = new Vue({
    el: "#app",
    data(){

        return{

            b: 5
        }
    },
    router,
    render: h => h(App)
}).$mount("#app");

app.$validator.localize('en', message);

//app.$validator.updateDictionary(messages);
