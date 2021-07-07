export const state = () => ({
    items: []
});

export const mutations = {
    itemAdd(state, itemData) {
        state.items.push(itemData);
    },
    itemRemove(state, i) {
        state.items.splice(i, 1);
    },
    itemsClear(state) {
        state.items = [];
    },
    updateCount (state, newQuantity) {
        state.items[newQuantity.index].quantity = newQuantity.quantity;
    }
};

export const actions = {
    async order(state, uuid) {
        const sendData = {
            'uuid': uuid
        }
        const orderId = await this.$axios.post("http://127.0.0.1:8000/api/order/", sendData)
        for (let index = 0; index < state.state.items.length; index++) {
            const item = state.state.items[index];
            const sendData = {
                item_id: item.item_id,
                user_id: item.user_id,
                order_id: orderId.data.data.id,
                quantity: item.quantity
            }
            await this.$axios.post("http://127.0.0.1:8000/api/order_detail/", sendData)
        }
            state.commit("itemsClear")
            this.$router.push({path:"/thanks", query: {orderUuid: orderId.data.data.uuid}});
    }
}