<template>
    <div>

    		<el-image
      class="background"
      :src="src"
      ></el-image>
      <div class="container">
        <div style="height:80px ">
          <el-row>
        <el-col >
          <div style="margin: 0 auto ;width: 120px;margin-left:40%">
                         <div style="  margin-top: -60px;z-index: 1px; border: 3px solid #fff" class="position-absolute rounded-circle   bg-white">
                             <img src="https://photo7n.gracg.com/2001292211_3_1e7f131ee259b607036c0a45f125bd6a.jpg!200x200" style="width: 120px;height:120px; " class="rounded-circle ">
                         </div>

                     </div>
          </el-col>

          <el-col style="margin-left:42%">
            <el-button type="primary" style="margin-top:10%" @click="addwatch()">关注</el-button>
          </el-col>
          <el-col><span></span></el-col>
    <div>

    <el-col>
<el-divider></el-divider>
     <span style="margin-left:42%">作品列表</span>
          </el-col></div>
</el-row>

    <el-col :span="6" v-for="img in list2" :key="img.a_id" class="imgcard" style="padding:7px">
        <el-card :body-style="{ padding: '0px' }"  shadow="never" >
          <el-image :src="img.i_img"></el-image>
                    <div style="padding: 7px;">
            <span style="font-size:12px" @click="showImgDetail(img.i_id)">{{img.i_title}}</span>
          </div><div class="bottom clearfix" style="padding:5px ">
            <span style="font-size:12px">创建于：{{img.create_time}}</span>
          </div>
        </el-card>
      </el-col>
        </div>
        

      </div>
    	</el-row>
    </div>
    </div>
</template>
<script type="text/ecmascript-6">
import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'
import {getimgTitleList} from '@/api/Img'
import {addwatch} from '@/api/article'
    export default {
        data(){
            return {
            	src:'https://qiniucssjs.gracg.com/bg2.jpg',
              list2:[],
              follow:{
                user_id:'',
                followed_userid:''
      }
            }
        },
    methods:{
    ...mapActions(['getImgList']),
    getimgList(id){
      getimgTitleList(id).then(response => {
        this.list2 = response.data.data
      })
        },
    showImgDetail(id) {
      this.$router.push({
        name: 'img', params: { id }
      })
    },
    addwatch(){
      this.follow.user_id = this.user.user_id
      this.follow.followed_userid=this.$route.params.id
      if(this.follow.user_id==this.follow.followed_userid){
        this.$notify.success({
            title: '失败',
            message: '不能关注自己哦'
          })
      }
      else{addwatch(this.follow).then(response => {
        this.$notify.success({
            title: '成功',
            message: '关注成功！'
          })
      })}

    }
    },
    mounted: function() { 
    const id=this.$route.params.id
    this.getimgList(id)
},
  computed: {
    ...mapGetters(['user']),
},
  }

</script>
<style>
.background{
  background-size:cover;
  background_position:center;
  width:100%;
  height:200px;
}
.container{
  width:100%;
  padding-right:15px;
  padding_left:15px;
  margin-right:auto;
  margin-left:auto;
}
.rounded-circle 
{
  border-radius: 50% !important;
}
.bg-white{
  background-color:#fff;
}
.position-absolute{
  position: absolute !important;
  border: 3px solid #fff;
}
</style>