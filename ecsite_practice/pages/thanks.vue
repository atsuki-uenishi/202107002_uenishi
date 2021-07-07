<template>
    <div class="thanks">
        <Header/>
            <div class="container">
                <h2 class="thanks-h2">ありがとうございます。注文が確定されました。</h2>
                <p class="thanks-p">注文内容と配送状況についてはEメールでお知らせをご確認ください。</p>

                <div class="order">
                    <p class="order-text">注文番号</p>
                    <p class="order-uuid">{{this.$route.query.orderUuid}}</p>
                    <p class="order-text">で承りました</p>
                    <button class="shop-btn" @click="toTop">ショッピングを続ける</button>
                </div>
            </div>
        <Footer/>
    </div>
</template>

<script>
export default {
    data() {
        return {
            order: ""
        }
    },
    methods: {
        toTop() {
            this.$router.push("/top");
        }
    }
}
</script>

<style scoped>
.thanks {
    width: 100%;
    height: 100vh;
}
.container {
    width: 70%;
    height: 80%;
    text-align: center;
    margin: 100px auto 0;
}
.thanks-h2 {
    font-size: 2rem;
    margin-bottom: 30px;
}
.thanks-p {
    margin-bottom: 50px;
}
.order {
    width: 70%;
    margin: 0 auto;
    background-color: #eee;
    padding: 50px 0;
}

.order-text {
    font-size: 1.1rem;
    margin-bottom: 30px;
}
.order-uuid {
    margin-bottom: 30px;
    font-size: 1.8rem;
    font-weight: bold;
}
.shop-btn {
  display: block;
  font-size: 1.1rem;
  color: #fff;
  background-color: #97b447;
  border: 1px solid #97b447;
  border-radius: 20px;
  padding: 5px 70px;
  margin-top: 20px;
  cursor: pointer;
  margin: 0 auto;
}

</style>