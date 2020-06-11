export default {
    namespaced:true,
    state : {
        dialog : false,
    },
    mutations : {
        Dialog : (state , payload) => {
            state.dialog = payload
        },

    },

    actions : {

        setDialog : ({commit},payload) =>{
            commit('Dialog',payload)
        },
    },

    getters : {
        dialog : state => state.dialog,
    }
}
