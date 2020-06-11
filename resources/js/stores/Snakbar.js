export default {
    namespaced:true,
    state : {
        status : false,
        color : 'red',
        pesan : ''
    },
    mutations : {
        setSnakbar : (state , payload) => {
            state.status = payload.status,
            state.color = payload.color,
            state.pesan = payload.pesan
        },

    },

    actions : {

        setSnakbar : ({commit},payload) =>{
            commit('setSnakbar',payload)
        },
    },

    getters : {
        status : state => state.status,
        color : state => state.color,
        pesan : state => state.pesan,
    }
}
