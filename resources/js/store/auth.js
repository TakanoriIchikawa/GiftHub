const state = {
    user: null
}

const getters = {
    check: state => !! state.user,
    name: state => state.user.name ? state.user.name : '',
    email: state => state.user.email ? state.user.email : '',
}

const mutations = {
    setUser (state, user) {
        state.user = user
        console.log('通過です。setUser')
        console.log(state.user)
    }
}

const actions = {
    async register (context, data) {
        data.userToken = 'chiachia0223'
        var user = {
            name: data.name,
            email: data.email,
            userToken: data.userToken,
        }
        context.commit('setUser', user)
    },
    async login (context, data) {
        var user = {
            loginId: data.loginId,
            userToken: data.userToken,
        }
        context.commit('setUser', user)
    },
    async logout (context) {
        
    },
    async currentUser (context) {
        var user = {
            name: '市川千耀',
            email: 'axela0104@icloud.com',
        }
        context.commit('setUser', user)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}