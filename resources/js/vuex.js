import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        client: null
    },
    mutations: {
        updateClient(state, client) {
            state.client = client;
        }
    }
});

export default store;