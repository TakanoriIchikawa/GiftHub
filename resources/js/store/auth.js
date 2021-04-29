const state = {
    user: {}
}

const getters = {
    check: state => state.user.name ? true : false,
    name: state => state.user.name ? state.user.name : '',
    email: state => state.user.email ? state.user.email : '',
}

const mutations = {
    setUser (state, user) {
        state.user = user
    }
}

const actions = {
    async register (context, data) {
        return await axios.post('/api/register', data)
        .then ( response => {
            context.commit('setUser', response.data);
            return true;
        }).catch( error => { 
            console.log(error);
            return false;
        })
    },
    async login (context, data) {
        return await axios.post('/api/login', data)
        .then ( response => {
            context.commit('setUser', response.data);
            return true;
        }).catch( error => { 
            console.log(error);
            return false;
        })
    },
    async logout (context) {
        await axios.post('/api/logout')
        .then ( response => {
            context.commit('setUser', {})
        }).catch( error => { 
            console.log(error);
        })
    },
    async currentUser (context) {
        await axios.post('/api/user')
        .then ( response => {
            context.commit('setUser', response.data)
        }).catch( error => { 
            console.log(error);
        })
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}