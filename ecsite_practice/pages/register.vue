<template>
  <div class="login-register">
    <Header/>
    <div class="container flex">
      <div class="login">
        <h2>ログイン</h2>
        <div class="customer">
          会員のお客様
        </div>
        <p class="customer-text">メールアドレスとパスワードを入力してログインしてください。</p>
        <form class="input" @submit.prevent="login">
          <label>メールアドレス: <input type="email" v-model="emailLogin" placeholder="email"></label>
          <label>パスワード: <input type="password" v-model="passwordLogin" placeholder="password"></label>
          <button class="login-btn btn" type="submit">ログイン</button>
        </form>
      </div>
      <div class="register">
        <h2>新規会員登録</h2>
        <div class="customer">
          初めてご利用の方・会員以外の方
        </div>
        <p class="customer-text">初めてご利用のお客様は、こちらから会員登録を行ってください。</p>
        <form class="input" @submit.prevent="register">
          <validation-provider v-slot="ProviderProps" rules="required|email">
            <label>メールアドレス: <input type="email" v-model="emailRegister" name="email" placeholder="email"></label>
            <div class="error">{{ ProviderProps.errors[0] }}</div>
          </validation-provider>
          <validation-provider v-slot="ProviderProps" rules="required|min:6">
          <label>パスワード: <input type="password" name="password" v-model="passwordRegister" placeholder="password"></label>
          <div class="error">{{ ProviderProps.errors[0] }}</div>
          </validation-provider>
          <validation-provider v-slot="ProviderProps" rules="required|min:4">
          <label>お名前: <input type="name" v-model="name" name="name" placeholder="name"></label>
          <div class="error">{{ ProviderProps.errors[0] }}</div>
          </validation-provider>
          <button class="register-btn btn" type="submit">新規会員登録</button>
        </form>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
export default {
    data() {
        return {
        emailLogin: "",
        passwordLogin: "",
        emailRegister: "",
        passwordRegister: "",
        name: ""
    }
    },
    methods: {
    async login() {
      try {
        await this.$auth.loginWith("laravelJWT", {
          data: {
            email: this.emailLogin,
            password: this.passwordLogin
          },
        });
        this.$router.push("/");
      } catch {
        alert("メールアドレスまたはパスワードが間違っております")
      }
    },
    async register() {
      try {
        await this.$axios.post("http://localhost:8000/api/auth/register", {
          name: this.name,
          email: this.emailRegister,
          password: this.passwordRegister
        });
        alert("登録が完了しました")
        this.name = ""
        this.emailRegister =""
        this.passwordRegister = ""
      } catch {
        alert("メールアドレスがすでに登録されています。")
      }
    }
}
}
</script>

<style scoped>
.login-register{
  width: 100%;
  height: 100vh;
}
.container {
    width: 90%;
    justify-content: center;
    align-items: center;
    height: 90%;
    margin: 0 auto;
  }

.login {
  margin-right: 20px;
}

.register {
  margin-left: 20px;
}

.customer {
  font-size: 1.2rem;
  font-weight: bold;
  border-bottom: 2px solid #000;
  padding-bottom: 1px;
  margin-bottom: 30px;
}

.customer-text {
  width: 95%;
  margin: 0 auto;

}

.input {
  margin-top: 20px;
}

label {
  display: block;
  text-align: right;
  font-weight: bold;
}
label input {
  width: 60%;
}

.btn {
    display: block;
    color: #fff;
    padding: .1rem 4rem;
    margin: 0 auto;
  }

.login-btn{
  background-color: #000;
  margin-top: 60px;
}

.register-btn{
  background-color: #97b447;
  margin-top: 35px;
}

.error {
    color: red;
    text-align: center;
  }
</style>