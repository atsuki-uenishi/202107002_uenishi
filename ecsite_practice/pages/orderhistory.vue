<template>
    <div class="order-history">
        <Header/>
        <div class="container">
            <h2>購入履歴</h2>
            <div class="item flex" v-for="order in getItems" :key="order.id">
                <img class="item-img" :src="order.item.file_path">
                <div class="order">
                    <p class="order-uuid">注文番号:{{order.order.uuid}}</p>
                    <div class="item-detail flex">
                        <p class="order-item">{{order.item.name}}</p>
                        <div class="order-detail flex">
                          <p >{{order.created_at | dateFormat}}</p>
                          <p >合計{{order.quantity}}個</p>
                          <p >¥{{order.item.price | locaeString}}(税込)</p>
                        </div>
                    </div>
                    <a class="to-buy" @click="toBuy(order.item.id)">もう一度購入する</a>
                </div>
            </div>
            <paginate
                :page-count="getPageCount"
                :page-range="5"
                :margin-pages="3"
                :click-handler="clickCallback"
                :prev-text="'前へ'"
                :next-text="'次へ'"
                :container-class="'pagination flex'"
                :page-class="'pagination-item'"
                :page-link-class="'pagination-item__link'"
                :prev-class="'pagination-btn pagination-prev'"
                :prev-link-class="'pagination-btn__link'"
                :next-class="'pagination-btn pagination-next'"
                :next-link-class="'pagination-btn__link'"
                :hide-prev-next="true"
            ></paginate>
        </div>
        <Footer/>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data() {
        return {
            orders: [],
            parPage: 8,
            currentPage: 1
        }
    },
    methods: {
      async getOrders() {
        const resData = await this.$axios.get("http://127.0.0.1:8000/api/order_detail/", {params: {user_id: 1}});
        this.orders = resData.data.data;
      },
      toBuy(id) {
        this.$router.push({path: '/', query: {itemId: id}});
      },
      clickCallback: function (pageNum) {
        this.currentPage = Number(pageNum);
      }
    },
    computed: {
      getItems() {
        let current = this.currentPage * this.parPage;
        let start = current - this.parPage;
        return this.orders.slice(start, current);
      },
      getPageCount() {
        return Math.ceil(this.orders.length / this.parPage);
      }
    },
    filters: {
      locaeString(value) {
        if(!value) {
          return 0
        }
        return value.toLocaleString()
      },
      dateFormat(date) {
        return moment(date).format('YYYY年MM月DD日');
      }
    },
    created() {
      this.getOrders();
    }

}
</script>


<style scoped>
.order-history {
  width: 100%;
}
.container {
  width: 70%;
  min-height: 100vh;
  margin: 80px auto 50px;
}
.container h2 {
  font-size: 1.8rem;
  margin-bottom: 50px;
}

.item {
  border-top: 1px solid #888;
  border-bottom: 1px solid #888;
  padding: 15px 0;
  width: 100%;
  justify-content: space-between;
}

.order {
    width: 80%;
    align-items: center;
    margin: 10px 0 0 20px ;
}

.item-img{
  width: 150px;
  height: 150px;
}

.order-item {
  font-size: 1.5rem;
}
.order-uuid {
  color: #888;
}

.order-detail {
  color: #888;
  justify-content: space-between;
  width: 50%;
}

.item-detail {
  justify-content: space-between;
  margin: 30px 0;
  width: 100%;
}

.to-buy {
  cursor: pointer;
  color: #888;
}

</style>

<style>
.pagination {
  width: 100%;
  margin: 50px auto 0;
  justify-content: center;
  margin-bottom: 40px;
}

.pagination-item, .pagination-prev, .pagination-next{
  list-style: none;
}

.pagination-btn__link,
.pagination-item__link {
  border: solid 2px #97b447;
  border-radius: 20px;
  text-align: center;
  padding: .4rem 1.6rem;
  margin: 0 .4rem;
  display: block;
}
.pagination-btn__link:hover,
.pagination-item__link:hover {
  background-color: #97b447;
  color: #fff;
}
.active .pagination-item__link {
  background-color: #97b447;
  color: #fff;
  pointer-events: none;
}
</style>
