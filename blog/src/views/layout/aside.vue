<template>
  <aside class="f-r contain">
         <el-card :body-style="{ padding: '0px' }"  shadow="always" >
        <div class="contain juzhong font-weight-bold">
          <el-row>
          <div style="margin-top:14px">
                <el-avatar src="https://photo7n.gracg.com/2001295629_1_7a3569123c04c0d0386862a8e51390cf.jpg!200x200" ></el-avatar>
              </div>
            </el-row>
<el-row>
    <a style="font-size:18px"> ww </a></el-row>
<el-row style="font-size:18px;padding-top14px;padding-bottom:14px">
  <span style="color: #999;">人气：</span><span>23</span>
</el-row>
<el-row style="padding:7px">
  <el-button type="primary" >关注</el-button>
</el-row>
      </div>
        </el-card>
  </aside>
</template>
<script>
import { mapActions, mapState, mapMutations,mapGetters } from 'vuex'
import { getList } from '@/api/tags'
import { getList as getNeighborsList } from '@/api/neighbors'
import { getTime } from '@/utils'
export default {
  data() {
    return {

    }
  },
    computed: {
    ...mapGetters(['user']),
},
  created: function() {

    const id2=this.article.user_id
    getauthor(id2)

  }
}
</script>

<style scoped>
.juzhong{
text-align: center;
}
.contain{
  padding-top:21px;
  padding-bottom:21px;
  width:200px;
}
.el-avatar{
  width:80px;
  height:80px;
}
.font-weight-bold {
    font-weight: 700 !important;
  }

</style>
