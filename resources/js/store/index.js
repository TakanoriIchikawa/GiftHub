import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import auth from './auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
    },
    strict: true,
    plugins: [createPersistedState({
        key: 'AAAAA',
        paths: ['auth.user'],
        storage: window.sessionStorage
    })]
})

export default store