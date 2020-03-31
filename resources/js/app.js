/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import store from './store'
import VueRouter from 'vue-router'
import MessengerComponent from './components/MessengerComponent.vue'

Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('contact-component', require('./components/ContactComponent.vue').default);
Vue.component('contacts-list-component', require('./components/ContactsListComponent.vue').default);
Vue.component('contacts-form-component', require('./components/ContactsFormComponent.vue').default);
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue').default);
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue').default);
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue').default);
// Vue.component('messenger-component', require('./components/MessengerComponent.vue').default);

const routes = [
    { path: '/chat', component: MessengerComponent },
    { path: '/chat/:conversationId', component: MessengerComponent }
];


const router = new VueRouter({
    routes,
    mode: 'history'
})


const app = new Vue({
    el: '#app',
    store,
    router
});
