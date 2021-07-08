<template>
    <header>
        <h1 class="header-logo" @click="toTop">Trace</h1>
        <nav class="nav">
            <ul class="nav-list">
                <li v-if="$auth.loggedIn" >Name : {{$auth.user.name}}</li>
                <li ><img @click="toCart" src="../assets/img/cart.png"></li>
                <li><img @click="toOrderhistory" src="../assets/img/user.png"></li>
                <li v-if="$auth.loggedIn" class="logout" @click="logout"><img src="../assets/img/logout.png"></li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    data() {
        return{
        }
    },
    methods: {
        async logout() {
            try {
                await this.$auth.logout();
                this.$router.push("/register");
            } catch (error) {
                console.log(error);
            }
            this.$store.commit("cart/itemsClear")
        },
        toTop() {
            this.$router.push("/");
        },
        toCart() {
            if(!this.$auth.loggedIn) {
                alert("ログインしてください")
                return this.$router.push("/register");
                }
            this.$router.push("/cart");
        },
        toOrderhistory() {
            if(!this.$auth.loggedIn) {
                alert("ログインしてください")
                return this.$router.push("/register");
                }
            this.$router.push("/ordrehistory");
        }
    }
}
</script>

<style scoped>
header {
    width: 90%;
    height: 40px;
    display: flex;
    justify-content: space-between;
    margin: 10px auto;
    border-bottom: 1px solid #ccc;
}
.header-logo {
    font-size: 2rem;
    margin-left: 10px;
    cursor: pointer;
}
.nav-list {
    display: flex;
    align-items: center;
    margin-right: 10px;
}
.nav-list li {
    margin-right: 15px;
}
.nav-list img {
    width: 30px;
    cursor: pointer;
}
li {
    list-style: none;
}
.logout {
    cursor: pointer;
}
</style>