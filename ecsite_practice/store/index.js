export const state = () => ({
    userId: "",
})

export const mutations = {
    userIdSet(state, payload) {
        state.userId = payload;
    },
}