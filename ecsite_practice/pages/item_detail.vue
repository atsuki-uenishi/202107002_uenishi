<template>
  <div class="detail">
    <Header/>
    <div class="container">
        <div class="item-detail flex">
          <img class="item-img" :src="item.file_path">
          <div class="item-data">
            <p class="item-name">{{item.name}}</p>
            <p class="item-price">¥{{item.price | locaeString}}(税込)</p>
            <p class="item-count">個数 <input type="number" v-model="quantity"></p>
            <button class="cart-btn" @click="toCart(item.id)"><img src="../assets/img/whitecart.png">カートに入れる</button>
          </div>
        </div>
        <div class="item-description">
          <h2>毎日履きたくなる、スニーカー。</h2>
          <p>朝の支度が、格段にラクになる一足。シンプルで飽きの来ないチームコートは、クリーンでモダンな、
            デザインが魅力。合わせたいのは、デニムやバギースウェット。スタイリッシュなレザーアッパーと
            フレッシュなカラーが、どんなコーディネートも引き締めてくれる。もちろん、履き心地の良さも言うことなし。
          </p>
        </div>
      </div>
    <Footer/>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: "",
      quantity: ""
    }
  },
  methods: {
    toCart(item) {
      if(!this.$auth.loggedIn) {
        alert("ログインしてください")
        return this.$router.push("/register");
      }  
      if((this.quantity % 1) !== 0 || Math.sign(this.quantity) !==1){
        return alert("個数が不適切です");
      }
      const itemData = {
            item_id: item,
            user_id: this.$auth.user.name,
            quantity: Number(this.quantity)
        }
      this.$store.commit("cart/itemAdd", itemData);
      this.$router.push("/cart");
    },
    async getItem() {
      const id = this.$route.query.itemId;
      const resData = await this.$axios.get("http://127.0.0.1:8000/api/item/" + id);
      this.item = resData.data.data;
    }
  },
  filters: {
      locaeString(value) {
        if(!value) {
          return 0
        }
        return value.toLocaleString()
      },
    },
  created() {
    this.getItem()
  }
}
</script>

<style scoped>
.detail {
  width: 100%;
  height: 100vh;
}
.container {
  width: 50%;
  height: 80%;
  margin: 0 auto;
}
.item-detail {
  width: 100%;
  margin: 100px 0 80px;
}

.item-data {
  margin-left: 30px;
}
.item-name {
  font-size: 1.3rem;
  margin-top: 10px;
}

.item-price {
  font-size: 2em;
  font-weight: bold;
  margin-top: 25px;
}

.item-count {
  margin-top: 20px;
}

.item-data input {
  border: none;
  background-color: #eee;
  width: 100px;
}

.item-img{
  width: 200px;
  height: 200px;
}

.cart-btn {
  display: block;
  font-size: 1.1rem;
  color: #fff;
  background-color: #97b447;
  border: 1px solid #97b447;
  border-radius: 20px;
  padding: 1px 20px;
  margin-top: 20px;
  cursor: pointer;
}
.cart-btn img {
  vertical-align: middle;
}

.item-description {
  width: 100%;
  display: block;
}
.item-description h2 {
  margin-bottom: 20px;
}
</style>