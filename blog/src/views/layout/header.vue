<template>
<div>
<el-menu
  router
  :default-active="routePath"
  class="el-menu-demo"
  mode="horizontal"
  background-color="#545c64"
  text-color="#fff"
  active-text-color="#ffd04b">
  <el-menu-item index="/imgList" :route="{path: '/imgList'}">首页</el-menu-item>
  <el-menu-item index="/articleList" :route="{path: '/articleList'}">漫者论坛</el-menu-item>
  <el-submenu v-if="user" style="margin-left:70%">
    <template slot="title">{{ user.user_name }}</template>
    
    <el-menu-item index="/usercenter" :route="{path: '/usercenter'}">个人中心</el-menu-item>
    <el-menu-item @click="logout" v-if="user">登出</el-menu-item>
  </el-submenu>
  <el-menu-item style="margin-left:70%" index="/mylogin" :route="{path: '/mylogin'}" v-if="!user">登录</el-menu-item>
  <el-menu-item index="/register" :route="{path: '/register'}" v-if="!user">注册</el-menu-item>

</el-menu>
  
</div>
</template>
<script>
import { getStorage } from '@/utils/storage'
import { mapActions, mapState, mapMutations, mapGetters } from 'vuex'
export default {
  data() {
    return {
      user: null,
      routePath: null,
      activeIndex: '1'
    }
  },
  created() {
    this.user = getStorage('user')
    this.routePath = this.$route.path
  },
  methods: {
    ...mapMutations(['CLOSE_LOGOUT_BOX', 'TOOGLE_SIDEBAR']),
    ...mapActions(['logOut']),
    logout: function() {
      this.$router.push('/')
      parent.location.reload();
      this.CLOSE_LOGOUT_BOX()
      this.logOut()
    },
    handleSelect(key, keyPath) {
      switch (key) {
        case '1':
          this.$router.push('/imgList')
          this.breadcrumbItems = ['首页']
          break
        case '2':
          this.$router.push('/articleList')
          this.breadcrumbItems = ['漫者论坛']
          break
        case '3':
          this.$router.push('/usercenter')
          this.breadcrumbItems = ['个人中心']
          break
        case '4':
          this.$router.push('/mylogin')
          this.breadcrumbItems = ['登录']
          break
        case '5':
          this.$router.push('/register')
          this.breadcrumbItems = ['注册']
          break
      }
      console.log(key, keyPath)
    }
  },
  watch: {
    $route(to, from) {
      this.routePath = to.path
    }
  }
}
</script>
