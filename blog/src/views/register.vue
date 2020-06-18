<template>
  <div>
    <el-row :gutter="20" style="background-color: #f8f9fa !important;">
      <el-col :span="6" :offset="8" style="padding-bottom: 3rem !important;
  padding-top: 3rem !important;" >
    <el-card class="box-card2">

     <el-form ref="form" :model="form" label-width="80px">
  <el-form-item label="邮箱账号">
    <el-input v-model="form.email" ref="input_email" @input="check_email"></el-input>
    <i class="glyphicon" :class="icon.email"></i>
  </el-form-item>
    <el-form-item label="用户名">
    <el-input v-model="form.name" ref="input_name"
            @input="check_name"></el-input>
    <i class="glyphicon" :class="icon.name"></i>
  </el-form-item>
<el-form-item label="输入密码"><el-input placeholder="请输入密码" v-model="form.password" show-password ref="input_pwd"
            @input="check_pwd"></el-input>
  <i class="glyphicon" :class="icon.pwd"></i>
</el-form-item>

<el-form-item label="再次输入"><el-input placeholder="请再次输入密码" v-model="cpsw" show-password ref="input_cpwd" @input="check_cpwd"></el-input>
  <i class="glyphicon" :class="icon.cpwd"></i>
</el-form-item>

  <el-form-item label="注册身份">
    <el-radio-group v-model="form.resource">
      <el-radio label="个人"></el-radio>
      <el-radio label="企业"></el-radio>
    </el-radio-group>
  </el-form-item>
<!--   <el-form-item label="企业信息">
    <el-input type="textarea" v-model="form.desc"></el-input>
  </el-form-item> -->
  <el-form-item>
    <el-button type="primary" @click="onSubmit()" :disabled="register_btn">立即注册</el-button>
  </el-form-item>
</el-form>
</el-card>
</el-col>
</el-row>
</div>
</template>
<script type="text/ecmascript-6">
import { register } from '@/api/login'
export default {
  data(){
    return {
      form: {
          name: '',
          email: '',
          password: '',
        },
        check_result: {
        email: false,
        name: false,
        pwd: false,
        cpwd: false
      },
      icon: {
        name: '',
        email: '',
        pwd: '',
        cpwd: '',
      },
      cpsw:'',
      }
    },
    methods: {
      onSubmit() {
        register(this.form).then(response => {
        this.$message('注册成功，请登录')
      }),
        console.log(this.form);
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
    check_name() {
      this.check_result.name = false
      const name = this.$refs.input_name.value
      if (name) {
        if (name.length < 2 || name.length > 20) {
          this.icon.name = 'glyphicon-remove'
          // console.log('用户名不符合要求');
        } else {
          this.check_result.name = true
          this.icon.name = 'glyphicon-ok'
          // console.log('用户名正确');
        }
      } else {
        this.icon.name = 'glyphicon-remove'
        // console.log('用户名不能为空');
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
    check_cpwd() {
      this.check_result.cpwd = false
      const cpwd = this.$refs.input_cpwd.value
      if (this.form.password == this.cpsw) {
        this.icon.cpwd = 'glyphicon-ok'
        this.check_result.cpwd = true
        // console.log('密码验证正确');
      } else {
        this.icon.cpwd = 'glyphicon-remove'
        // console.log('两次输入密码不等');
      }
    },
    // 点击登录框阻止事件冒泡


  },
    computed: {
      register_btn: function() {
      if (
        this.check_result.email &&
        this.check_result.name &&
        this.check_result.pwd &&
        this.check_result.cpwd
      ) {
        return false
      } else {
        return 'disabled'
      }
    },
  },
    mounted() {
    this.check_email()
    this.check_name()
    this.check_pwd()
    this.check_cpwd()
  }
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

.box-card2 {
  width: 480px;
  height:100%;

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