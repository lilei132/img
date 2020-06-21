<template>
  <el-row :gutter="24">
    <el-col :span='20'>
  <el-card class="main container">
    <el-row > 
      <el-col :span="3">
      <div style="margin-top:5px">
                <el-avatar src="https://photo7n.gracg.com/2001295629_1_7a3569123c04c0d0386862a8e51390cf.jpg!200x200" ></el-avatar>
              </div>
</el-col>
<el-col :span="3">
  <div style="margin-top:16px"></div>
  <a style="font-size:16px；font-weight:700!important;" @click="showauthor(img.user.user_id)"> {{img.user.user_name}} </a>
</el-col>
  <el-col :span="2" :offset="16">
    <div style="margin-top:16px">
    <el-button type="primary" @click="addwatch()">关注</el-button>
  </div>
  </el-col>
    </el-row>

    <el-divider></el-divider>
    <el-row>
    <div class="imgmain">
      <span class="title">{{img.i_title}}</span>
    </div> 
  </el-row>
  <el-row class="create_time">
    发布于{{img.create_time}}
  </el-row>
  <el-row>
    <div class="bottom clearfix" style="padding:5px ">
            <i class="el-icon-view font-12" style="margin-right: 1rem !important;">7923</i>
            <i class="el-icon-chat-line-round font-12" style="margin-right: 1rem !important;" >{{img.comment_num}}</i>
            <i class="el-icon-star-off font-12" style="margin-right: 1rem !important;" >{{img.praise_num}}</i>
          </div>

  </el-row>
  <el-row :gutter="24">
    <el-col :span="3">
      <div><img style="width: 30px;flex-shrink: 0;" src="../../assets/imgs/work_hot.png" alt=""></div>
        <span class="font-12" style="font">热门</span>
    </el-col>
    <el-col  :span="3">
      <div><img style="width: 30px;flex-shrink: 0;" src="../../assets/imgs/work_tuijian.png" alt=""></div>
        <span class="font-12" style="font">推荐</span>
    </el-col>

  </el-row>
     <el-divider></el-divider>
     <el-row >
       “{{img.outline}}”
     </el-row>
<el-row class="top">
  <i class="el-icon-price-tag"></i>

  <el-tag type="info">{{img.tag.tag_name}}</el-tag>
</el-row>
<el-row>
  <i class="el-icon-apple" style="font-size:18px;"></i>
</el-row>
<el-row>
      <div class="content" style="text-align: center;" v-html="img.i_content"></div>
    </el-row>
    <el-row>
      <p class="praise">
        <i class="glyphicon glyphicon-thumbs-up"></i>
      </p>
      <p class="praise">
        <span>累计获得{{img.praise_num}}个赞</span>
      </p>
    </el-row>
<!--       <comment :articleID="img.a_id"></comment> -->
    
  </el-card>
</el-col>
</el-row>
</template>

<script>
import { mapActions, mapMutations,mapGetters} from 'vuex'
import comment from '@/views/components/comment.vue'
import { addwatch } from '@/api/article'
import { getOne,addimgPraise } from '@/api/Img'
import simplemde from 'simplemde'
import AsideBar from '@/views/layout/aside.vue'
export default {
  data() {
    return {
      img: {
        comment_num: '',
        create_time:'',
        i_content: '',
        i_id: '',
        i_img: '',
        i_title: '',
        outline:'',
        praise_num: '',
        published: '',
        status: '',
        tag: {},
        tag_id: '',
        update_time: '',
        user: {},
        user_id: '',
        viewer_num: ''
      },
      follow:{
        user_id:'',
        followed_userid:''
      }
    }
  },
  components: {
    comment,
    AsideBar
  },
  methods: {
    ...mapActions(['getComment', 'addImgPraise']),
    ...mapMutations(['CHANGE_CRUMBS']),
    getOne(ID) {
      getOne(ID)
        .then(response => {
          const content = response.data.data.i_content
          response.data.data.i_content = simplemde.prototype.markdown(content)
          this.img = response.data.data
          const obj = {
            tagName: this.img.tag.tag_name,
            tagID: this.img.tag.tag_id,
            title: this.img.a_title
          }
          this.CHANGE_CRUMBS(obj)
        })
        .catch(error => {
          this.SHOW_ALERT(error.response.data.msg)
        })
    },
    addwatch(){
      this.follow.user_id = this.user.user_id
      this.follow.followed_userid=this.img.user_id
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

    },
    showauthor(id) {
      this.$router.push({
        name: 'author', params: { id }
      })
    },
  
},
computed: {
    ...mapGetters(['user']),
    },
  created: function() {
    const id = this.$route.params.id
    this.getOne(id)

},


}
</script>

<style>
.container{
  margin-left:10%;
  margin-right:10%;
  margin-top:2%;
  margin-bottom:2%;
}
.content img {width:100%}
.imgmain{

}
.el-avatar{
  width:43px;
  height:43px;
}
body{
  font-family: PingFang SC, Verdana, Helvetica Neue, Microsoft Yahei, Hiragino Sans GB, Microsoft Sans Serif, WenQuanYi Micro Hei, sans-serif;
}
.title{
  font-size:24px;
  font-weight:700!important;
}
.create_time{
  color:#999;
  font-size:13px;
}
.top{
  margin-top:21px;
}
.like :before{
  color:#999
}
.like :after{
  color:#0000
}

.glyphicon glyphicon-thumbs-up{
   width: 36px !important; 
    height: 36px !important; 
}
.praise {
  text-align: center;
  margin-top: 10px;
  height: 40px;
  line-height: 40px;
}
.praise span {
  display: inline-block;
}
.praise i {
  cursor: pointer;
  color: #ec919d;
  font-size: 40px;
}

.praise i:hover {
  font-size: 50px;
  color: #ec5057;
  transition: 0.6s all;
}
</style>
