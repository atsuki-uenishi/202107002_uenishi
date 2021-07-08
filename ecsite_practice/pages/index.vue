<template>
<div class="top">
    <Header/>
    <div class="container">
        <div class="firstview">
            <img class="firstview-img" src="../assets/img/sandal.jpg">
            <div class="firstview-text">
                <h2>New Arrivals</h2>
                <p>for BOYS & GIRLS</p>
            </div>

        </div>
        <div class="section">
            <h2 class="section-title">Products</h2>
            <div class="item-list flex">
              <div class="item" v-for="item in getItems" :key="item.id">
                <img class="item-img" :src="item.file_path" @click="toDetail(item.id)">
                <p>{{item.name}}</p>
                <p>¥{{item.price | locaeString}}(税込)</p>
              </div>
              <paginate
                :page-count="getPageCount"
                :page-range="3"
                :margin-pages="1"
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
        </div>
    </div>
    <Footer/>
</div>
</template>

<script>
export default {
    data() {
        return{
          items: [],
          parPage: 8,
          currentPage: 1
        }
    },
    methods: {
      async showItems() {
        const resData = await this.$axios.get("http://127.0.0.1:8000/api/item/");
        this.items = resData.data.data;
      },
      toDetail(itemId) {
        this.$router.push({path: "/item_detail", query: {itemId: itemId}});
      },
      clickCallback: function (pageNum) {
        this.currentPage = Number(pageNum);
      }
    },
    computed: {
      getItems() {
        let current = this.currentPage * this.parPage;
        let start = current - this.parPage;
        return this.items.slice(start, current);
      },
      getPageCount() {
        return Math.ceil(this.items.length / this.parPage);
      }
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
      this.showItems()
    }
}
</script>

<style scoped>
.container {
  width: 90%;
  margin: 0 auto;
}
.firstview {
  position: relative;
}
.firstview-text {
  position: absolute;
  top: 50%;
  right: 8%;
}
.firstview-text h2 {
  font-size: 4rem;
  margin-bottom: 15px;
}
.firstview-text p {
  font-size: 1.5rem;
}
.firstview-img {
  object-fit: contain;
  width: 100%;
  margin: 0 auto;
  display: block;
}

.section {
  width: 100%;
  margin: 0 auto;
  margin-top: 10px;
}
.section-title {
  text-align: center;
  font-size: 2rem;
  margin-bottom: 10px;
}

.item-list {
  width: 100%;
  flex-wrap: wrap;
  justify-content: space-around;
}

.item {
  width: 20%;
  margin: 5px 5px 20px;
}

.item-img{
  width: 100%;
  height: 200px;
  object-fit: cover;
  cursor: pointer;
}



</style>

<style>
.pagination {
  width: 100%;
  margin: 20px auto 0;
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

