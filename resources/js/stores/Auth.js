export default {
    namespaced:true,
    state : {
        user : null,
        menu : null,
        token : null,
    },
    mutations : {
        Auth : (state , payload) => {
            state.user = payload.user,
            state.menu = payload.menu ? payload.menu : state.menu,
            state.token = payload.token ? payload.token : state.token
        },

    },

    actions : {

        setAuth : ({commit},payload) =>{
            commit('Auth',payload)
        },
    },

    getters : {
        user : state => state.user,
        menu : state => state.menu,
        token : state => state.token,
    }
}
