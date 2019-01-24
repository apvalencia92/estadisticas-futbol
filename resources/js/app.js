require('./bootstrap');

window.Vue = require('vue');


// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))


const app = new Vue({
    el: '#app',
    data: {
        imagen: '',
    },
    methods: {
        onFileSelected(e) {
            console.log(e)
            let file = e.target.files[0]; //Almacenamos la informacion de la imagen
            this.changeImage(file)
        },

        changeImage(file) {
            var reader = new FileReader(); //Permite leer archivos

            reader.onload = (e) => {
                this.imagen = e.target.result
            };
            reader.readAsDataURL(file);


        }
    }
});
