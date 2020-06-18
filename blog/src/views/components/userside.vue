<template>
        <el-card :body-style="{ padding: '0px' }"  shadow="always" >
        <div class="contain juzhong font-weight-bold">
          <el-row>
          <div style="margin-top:14px">
                <el-avatar src="https://photo7n.gracg.com/2001295629_1_7a3569123c04c0d0386862a8e51390cf.jpg!200x200" ></el-avatar>
              </div></el-row>
              <el-row>
                 <a style="font-size:18px">citursod</a></el-row>
<el-row style="font-size:18px;padding-top14px;padding-bottom:14px">
  <span style="color: #999;">人气：</span><span>23</span>
</el-row>
<el-row style="padding:7px">
  <el-button type="primary" >关注</el-button>
</el-row>
        </div>
        </el-card>
</template>

<script>
import { getAll } from '@/api/article'

export default {
  data() {
    return {
      timer: null
    }
  }
    }
</script>

<style>
.juzhong{
text-align: center;
}
.contain{
  padding-top:21px;
  padding-bottom:21px;
}
.el-avatar{
  width:80px;
  height:80px;
}
.font-weight-bold {
    font-weight: 700 !important;
  }
</style>