<template>
  <div class="cart">
    <Header/>
    <div class="container">
      <h2>ショッピングカート</h2>
      <div class="cartin flex">
        <div class="item-list">
          <div class="item flex" v-for="(item, index) in items" :key="index">
            <div class="item-detail flex">
              <img class="item-img" :src="item.file_path">
              <div class="item-name">
                <p>{{item.name}}</p>
                <a class="item-delete" @click="itemRemove(index)">削除する</a>
              </div>
            </div>
            <div class="item-price flex">
              <label>個数 <input class="price-input" type="number" :value="$store.state.cart.items[index].quantity" @input="updateCount($event.target.value, index)" ></label>
              <p> ¥{{item.price | locaeString}}(税込)</p>
            </div>
          </div>
        </div>
        <div class="order">
            <p class="order-text">合計: ¥{{totalPrice | locaeString}} 税込</p>
            <button class="order-btn" @click="orderSend()">注文する</button>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
import { v4 as uuidv4 } from 'uuid'
export default {
  data() {
    return {
      items: [],
      totalPrice: 0,
    }
  },
  methods: {
    itemRemove(item) {
      // this.items.splice(i,1);
      // return items;
      this.$store.commit("cart/itemRemove", item)
      this.items.splice(this.items.indexOf(item),1);
      this.totalPrice = 0;
      this.total();
    },
    orderSend() {
      if(this.items[0]) {
        for (let index = 0; index < this.$store.state.cart.items.length; index++) {
        const item = this.$store.state.cart.items[index];
        if( (item.quantity % 1) !== 0 || Math.sign(item.quantity) !== 1) {
          return alert("個数が不適切です");
          }
        }
        const uuid = uuidv4()
        this.$store.dispatch("cart/order", uuid)
      } else {
        return alert('カートが空です')
      }
      
    },
    updateCount(quantity,i) {
      const newQuantity = {
        quantity: quantity,
        index: i
      }
      this.$store.commit('cart/updateCount', newQuantity);
      this.totalPrice = 0;
      this.total();
  },
  async getItems() {
      const cartItems = this.$store.state.cart.items;
      for (let index = 0; index < cartItems.length; index++) {
        const item = cartItems[index];
        const id = item.item_id
        const resData = await this.$axios.get("http://127.0.0.1:8000/api/item/" + id);
        this.items.push(resData.data.data)
      }
    },
    async total() {
      for (let index = 0; index < this.$store.state.cart.items.length; index++) {
            const item = this.$store.state.cart.items[index];
            const resData =  await this.$axios.get("http://127.0.0.1:8000/api/item/" + item.item_id);
            const price = resData.data.data.price;
            this.totalPrice += (item.quantity * price);
        }
    },
  },
  computed: {
    cartItems() {
      return this.$store.state.cart.items;
    },
  },
  filters: {
      locaeString(value) {
        if(!value) {
          return 0
        }
        return value.toLocaleString()
      }
    },
  created() {
      this.getItems()
      this.total()
    }
}
</script>


<style scoped>

.container {
    width: 90%;
    margin: 0 auto;
    min-height: 100vh;
  }

h2 {
  font-size: 1.5rem;
  margin-top: 50px;
}

.cartin {
  width: 100%;
  margin: 30px auto 0;
  align-items: center;
  }
.item-list {
  width: 50%;
  margin-right: 10%;
  
  }
.item {
  width: 100%;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #888;
  border-top: 1px solid #888;
  padding: 15px 0;
  height: 70%;
}

.item-img {
  width: 100px;
}
.item-detail {
  align-items: center;
}
.item-name {
  margin-left: 10px;
}
.item-delete {
  margin-top: 30px;
  margin-left: 20px;
  color: #888;
  cursor: pointer;
  display: inline-block;
}
.price-input {
  width: 50px;
}

.order {
  background-color: #eee;
  width: 30%;
}
.order-text {
  text-align: center;
  font-size: 1.5rem;
  font-weight: bold;
  margin-top: 50px;
}
.order-btn {
  color: #fff;
  background-color: #97b447;
  border: 1px solid #97b447;
  border-radius: 20px;
  padding: 1px 50px;
  margin: 20px auto 70px;
  display: block;
  cursor: pointer;
  font-weight: bold;
  font-size: 1.1rem;
}


</style>