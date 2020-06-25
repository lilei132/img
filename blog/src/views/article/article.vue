<template>
  <el-row :gutter="10">
    <el-col :span='20'>
  <el-card class="main container">
        <el-row > 
      <el-col :span="3">
      <div style="margin-top:5px">
 <el-avatar :src="useravatar.user_avatar"></el-avatar>
              </div>
</el-col>
<el-col :span="3">
  <div style="margin-top:16px"></div>
  <a style="font-size:16px；font-weight:700!important;" @click="showauthor(article.user.user_id)"> {{article.user.user_name}} </a>
</el-col>
  <el-col :span="2" :offset="16">
    <div style="margin-top:16px">
    <el-button type="primary" @click="addwatch()" ref='btn1'>关注</el-button>
  </div>
  </el-col>
    </el-row>

    <el-divider></el-divider>
    <el-row>
    <div class="imgmain">
      <span class="title">{{article.a_title}}</span>
    </div> 
  </el-row>
  <el-row class="create_time">
    发布于{{article.create_time}}
  </el-row>
  <el-row>
    <div class="bottom clearfix" style="padding:5px ">
            <i class="el-icon-view font-12" style="margin-right: 1rem !important;">  {{article.viewer_num}}</i>
            <i class="el-icon-star-off font-12" style="margin-right: 1rem !important;" >  {{article.praise_num}}</i>
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
     <el-row>
       “{{article.outline}}”
     </el-row>
<el-row class="top">
  <i class="el-icon-price-tag"></i>

  <el-tag type="info">{{article.tag.tag_name}}</el-tag>
</el-row>
<el-row>
  <i class="el-icon-apple" style="font-size:18px;"></i>
</el-row>
<el-row>
      <div class="content" style="text-align: center;" v-html="article.a_content"></div>
    </el-row>
    <el-row>
      <p class="praise">
        <i class="glyphicon glyphicon-thumbs-up" @click="addArticlePraise(article.a_id)"></i>
      </p>
      <p class="praise">
        <span>累计获得{{article.praise_num}}个赞</span>
      </p>
    </el-row>
  </el-card>
</el-col>

</el-row>
</template>

<script>
import { mapActions, mapMutations,mapGetters } from 'vuex'
import comment from '@/views/components/comment.vue'
import { getOne,addwatch,addpageview} from '@/api/article'
import { getOneavatar } from '@/api/user'
import simplemde from 'simplemde'
import AsideBar from '@/views/layout/aside.vue'
export default {
  data() {
    return {
      article: {

        a_content: '',
        a_id: '',
        a_img: '',
        a_title: '',
        comment_num: '',
        create_time: '',
        praise_num: '',
        viewer_num:'',
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
      },
      shows:'已关注',
      useravatar:{
        user_avatar:""
      }

    }
  },
  components: {
    comment
  },
  methods: {
    ...mapActions(['addPraise']),
    ...mapMutations(['CHANGE_CRUMBS']),
    getOne(ID) {
      getOne(ID)
        .then(response => {
          const content = response.data.data.a_content
          response.data.data.a_content = simplemde.prototype.markdown(content)
          this.article = response.data.data
          var id3={id:this.article.user.user_id}

          getOneavatar(id3).then(response=>{
            this.useravatar=response.data.data
          }

            )
          const obj = {
            tagName: this.article.tag.tag_name,
            tagID: this.article.tag.tag_id,
            title: this.article.a_title
          }
          this.CHANGE_CRUMBS(obj)
        })
        .catch(error => {
          this.SHOW_ALERT(error.response.data.msg)
        })
    },

    addArticlePraise(id) {
      this.addPraise(id).then(() => {
        this.article.praise_num++
      })
    },
    addwatch(){
      var name = this.shows;
      this.shows = this.$refs.btn1.$el.innerText;
      this.$refs.btn1.$el.innerText = name
      this.follow.user_id = this.user.user_id
      this.follow.followed_userid=this.article.user_id
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
      })
    }

    },
    showauthor(id) {
      this.$router.push({
        name: 'author', params: { id }
      })
    },
    addpageview(id){
      addpageview(id)
    }

  },
  computed: {
    ...mapGetters(['user']),
},
  created: function() {
    const id = this.$route.params.id
    this.getOne(id)
    //addpageview(id)

  },
  mounted: function() {
  var id={id:this.$route.params.id}
  this.addpageview(id)
  }
  // mounted:{
  //   const authorid=this.article.user_id
  //   this.getauthor(authorid)
  // }
}
</script>

</script>

<style>
.container{
  margin-left:10%;
  margin-right:10%;
  margin-top:2%;
  margin-bottom:2%;
}
.imgmain{

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
.juzhong{
text-align: center;
}
.contain{
  padding-top:21px;
  padding-bottom:21px;
  width:200px;
}
.el-avatar{
  width:53px;
  height:53px;
}
.font-weight-bold {
    font-weight: 700 !important;
  }
</style>