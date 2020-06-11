export default {
    namespaced:true,
    state : {
        BeforeUrl : null,

    },
    mutations : {
        Url : (state , payload) => {
            state.BeforeUrl = payload
        },

    },

    actions : {

        setUrl : ({commit},payload) =>{
            commit('Url',payload)
        },
    },

    getters : {
        url : state => state.BeforeUrl,
    }
}
