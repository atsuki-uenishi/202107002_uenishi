<template>
    <header>
        <h1 class="header-logo">Trace</h1>
        <nav class="nav">
            <ul class="nav-list">
                <li v-if="$auth.loggedIn" >Name : {{$auth.user.name}}</li>
                <li ><nuxt-link to="/cart"><img src="../assets/img/cart.png"></nuxt-link></li>
                <li><nuxt-link to="/orderhistory"><img src="../assets/img/user.png"></nuxt-link></li>
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
}
li {
    list-style: none;
}
.logout {
    cursor: pointer;
}
</style>