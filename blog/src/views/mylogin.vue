<template>
  <div>
    <el-row :gutter="20" style="background-color: #f8f9fa !important;">
      <el-col :span="6" :offset="12" style="padding-bottom: 3rem !important;
  padding-top: 3rem !important;" >
    <el-card class="box-card1">
      <div slot="header" class="clearfix" style="text-align: center;">
        <span style="">账号密码</span>    
      </div>
   
<div class="input1">  
  <el-form ref="form" :model="loginForm" label-width="80px">
    <el-form-item>
      <el-input
      placeholder="请输入账号"
      ref="input_email"
      @input="check_email"
      v-model="loginForm.email"
      clearable style="padding:7px">
    </el-input>
    <i class="glyphicon" :class="icon.email"></i>
  </el-form-item>
  <el-form-item>
<el-input placeholder="请输入密码"
            ref="input_pwd" 
            @input="check_pwd"
            v-model="loginForm.password" show-password style="padding:7px"></el-input>
    <i class="glyphicon" :class="icon.pwd"></i>
          </el-form-item>
          </el-form>
 <el-row><el-col :span="2" :offset="9">
  <el-button type="primary" :disabled="login_btn" @click="handleLogin">登录</el-button></el-col></el-row>
</div>
</el-card>
</el-col>
</el-row>
</div>
</template>
<script type="text/ecmascript-6">
import { mapMutations, mapActions, mapGetters } from 'vuex'
export default {
  data(){
    return {
      loginForm: {
        email: '515738252@qq.com',
        password: '123123',
      },
      check_result: {
        email: false,
        pwd: false,
      },
      icon: {
        email: '',
        pwd: '',
      },
      }
    },
    methods:{
    ...mapActions(['login']),
    handleLogin() {
      this.login(this.loginForm)
        .then(() => {
            this.$router.push('/imgList');
        })
        .catch()
},
      check_email() {
      this.check_result.email = false
      const email = this.$refs.input_email.value
      console.log(email);
      if (email) {
        const reg = new RegExp(
          '^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$'
        ) // 正则表达式
        if (!reg.test(email)) {
          this.icon.email = 'glyphicon-remove'
          console.log('邮箱格式不正确');
        } else {
          this.check_result.email = true
          this.icon.email = 'glyphicon-ok'
          console.log('邮箱正确');
        }
      } else {
        this.icon.email = 'glyphicon-remove'
        console.log('邮箱不能为空');
      }
    },
    check_pwd() {
      this.check_result.pwd = false
      const pwd = this.$refs.input_pwd.value
      console.log(pwd);
      if (pwd) {
        if (pwd.length < 5 || name.length > 20) {
          this.icon.pwd = 'glyphicon-remove'
          // console.log('密码不符合要求');
          this.check_cpwd()
        } else {
          this.check_result.pwd = true
          this.icon.pwd = 'glyphicon-ok'
          if (pwd === this.cpsw) {
            this.icon.cpwd = 'glyphicon-ok'
            this.check_result.cpwd = true
          }
          // console.log('密码正确');
        }
      } else {
        this.icon.pwd = 'glyphicon-remove'
        // console.log('密码不能为空');
      }
    },
},

    mounted() {
    this.check_email()
    this.check_pwd()
  },
    computed: {
    login_btn: function() {
      if (this.check_result.email && this.check_result.pwd) {
        return false
      } else {
        return 'disabled'
      }
    }
  },
    
}


</script>
<style>
.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}

.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
}
.clearfix:after {
  clear: both
}

.box-card1 {
  width: 480px;
  height:410px;

}
.input1{
  padding-left: 3rem !important;
  padding-right: 3rem !important;
  padding-bottom: 1rem !important;
}

.glyphicon-remove {
  color: #900;
}

.glyphicon-ok {
  color: #090;
}
</style>