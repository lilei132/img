<template>
<div>
<el-menu
  :default-active="activeIndex"
  class="el-menu-demo"
  mode="horizontal"
  @select="handleSelect"
  background-color="#545c64"
  text-color="#fff"
  active-text-color="#ffd04b">
  <el-menu-item index="1">首页</el-menu-item>
  <el-menu-item index="2">漫者论坛</el-menu-item>
  <el-menu-item index="3" >个人中心</el-menu-item>
    <el-menu-item index="4" >登录</el-menu-item>
        <el-menu-item index="5" >注册</el-menu-item>
</el-menu>

</div>
</template>
<script type="text/ecmascript-6">
   export default {
    data() {
      return {
        activeIndex: '1',
      };
    },
    methods: {
      handleSelect(key, keyPath) {
       switch(key){
        case '1':
        this.$router.push('/imgList');
        this.breadcrumbItems  = ['首页']
        break;
        case '2':
        this.$router.push('/articleList')
        this.breadcrumbItems  = ['漫者论坛']
        break;
        case '3':
        this.$router.push('/usercenter')
        this.breadcrumbItems  = ['个人中心']
        break;
        case '4':
        this.$router.push('/mylogin')
        this.breadcrumbItems  = ['登录']
        break;
        case '5':
        this.$router.push('/register')
        this.breadcrumbItems  = ['注册']
        break;
}
        console.log(key, keyPath);
      }
    }
  }
</script>