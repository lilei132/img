<template>
  <div class="main" @click="closeBox">
    <div class="write">
      <div class="center clearfix">
        <div class="title-top">
        <el-row >
        <el-image
      style="width: 100%; height: 100%"
      :src="src"
      ></el-image>

      </el-row>
      <el-row class="sidepadding">
        <el-steps finish-status="success">
  <el-step title="步骤 1" description="这里是论坛发布页面">
  </el-step>
  <el-step title="步骤 2" description="点击上传按钮，发布您的意见或需求">
  </el-step>
  <el-step title="步骤 3" description="发布成功，等待审核"></el-step>
</el-steps>
</el-row>
<el-row class="sidepadding">
          <input
            class="form-control title"
            type="text"
            name="title"
            v-model="article.a_title"
            placeholder="文章标题"
          >
          <div class="c-dropdown" style="margin-left:2%">
            <span class="c-button c-button-dropdown" @click="showTags">{{article.tag.tag_name}}</span>
            <transition name="show-tags">
              <ul class="c-dropdown__list" v-show="tags_box">
                <li
                  class="c-dropdown__item"
                  v-for="tag in tags"
                  :key="tag.tag_id"
                  :value="tag.tag_id"
                  @click="selectTag(tag)"
                >{{ tag.tag_name }}</li>
              </ul>
            </transition>
          </div>
        </el-row>
        </div>

        <div class="markdown f-l editor sidepadding">
          <div>
            <textarea
              class="outline"
              v-model="article.outline"
              cols="70"
              rows="3"
              placeholder="文章内容"
            ></textarea>
          </div>
          <markdown-editor
            v-model="article.a_content"
            ref="markdwonEditor"
            :configs="configs"
            :highlight="true"
            preview-class="markdown-body"
          ></markdown-editor>
</div></div>
      <el-row class="sidepadding" style="margin-left:18%">
      <button type="button" class="btn btn-success" v-if="create" @click="addArticle">发布文章</button>
      <button type="button" class="btn btn-danger" v-if="!(create)" @click="updateArticle">更新</button>
    </el-row>
  <el-dialog :visible.sync="zhifu"
  width="30%"
  style="text-align:center">
            <div class="title">发布需求请扫描支付</div>
            <img src='../../assets/imgs/qrcode.jpg' style="width:120px;padding:15px"> 
            <div class="content">
              <button type="button" class="btn btn-warning" @click="addqrArticle">支付成功</button>
              <button type="button" class="btn btn-info" @click="zhifu=false">取消</button>

        </div>
    </el-dialog>
    </div>
  </div>
</template>

<script>
// import markdownEditor from 'vue-simplemde/src/markdown-editor';
import { mapMutations, mapGetters } from 'vuex'
import { getOne, addArticle, updateArticle } from '@/api/article'
import { getList } from '@/api/tags'
export default {
  data() {
    return {
      zhifu:false,
      src:"https://photo7n.gracg.com/1540168448_0_dfebed584cdb2c2c810180cca9e6c3fa.jpg",
      article: {
        a_content: '',
        a_id: 0,
        a_img: '',
        a_title: '',
        outline: '',
        tag: {
          tag_id: 3,
          tag_name: '漫友闲聊',
          create_time: '1970-01-01 08:00:00'
        },
        images: [],
        tag_id: 3,
        user_id: 0,
      },
      create: true,
      tags: [],
      tags_box: false, // 控制标签选项盒子显示或隐藏
      imgs: [], // 图片上传预览框中的图片地址
      images: [], // 传递到后台的图片地址
      savedImgs: [], // 本次要保存的图片名集合
      configs: {
        status: false,
        spellChecker: false,
        placeholder: '内容'
      }
    }
  },
  methods: {
    ...mapMutations(['SHOW_ALERT']),
    getOne(id) {
      getOne(id).then(response => {
        this.article = response.data.data
      })
    },
    getTags() {
      getList('').then(response => {
        this.tags = response.data.data
      })
    },
    showTags() {
      this.tags_box = true
      this.stopProp()
    },
    selectTag(tag) {
      this.article.tag = tag
      this.article.tag_id = tag.tag_id
      console.log(this.article.tag_id)
      this.tags_box = false
    },
    stopProp(e) {
      e = e || event
      e.stopPropagation()
    },
    addArticle() {
      //this.article.imgs = this.savedImgs
      this.article.id=this.user.user_id
       console.log(this.article.tag.tag_id)
      if (this.article.tag.tag_id==4){
        this.zhifu=true
      }
      else{
      addArticle(this.article).then(response => {
        this.$router.push('/articleList')
      })}
    },
    addqrArticle() {
      //this.article.imgs = this.savedImgs
      addArticle(this.article).then(response => {
        this.$router.push('/articleList')
      })
    },
    updateArticle() {
      this.article.imgs = this.savedImgs
      updateArticle(this.article).then(respoonse => {
        this.$router.push('/admin/editor')
      })
    },
    closeBox() {
      this.tags_box = false
    },

  },
  computed: {
    ...mapGetters(['user'])
  },
  mounted() {
    this.getTags()
    const id = this.$route.params.id
    if (id) {
      this.create = false
      this.getOne(id)
    }
    this.article.user_id = this.user.user_id
  }
}
</script>

<style scoped>
/*@import '~simplemde/dist/simplemde.min.css';*/

.main {
  width: 100%;
  min-height: 800px;
}
.write {
  width: 90%;
  margin: 0 auto;
}
.title-top {
  margin: 20px 0;
}
.title-top .title,
.center .markdown {
  width: 70%;
  font-size: 18px;
  display: inline-block;
}
.title-top .title {
  width: 50%;
}
.center .file {
  width: 28%;
  text-align: center;
  padding: 20px;
  margin-left: 20px;
  border: 1px solid #ccc;
  background: #fff;
  border-radius: 10px;
}
.main .write .markdown-editor .CodeMirror,
.main .write .markdown-editor .CodeMirror-scroll {
  min-height: 500px;
}

.write
  .CodeMirror
  .cm-spell-error:not(.cm-url):not(.cm-comment):not(.cm-tag):not(.cm-word) {
  background: rgba(250, 250, 250, 0);
}
.write > button {
  margin-top: 20px;
  margin-bottom: 100px;
}
.outline {
  width: 100%;
}
.f-b{
  width:100%;
  border:1px;
  padding:20px;
  margin-top:10;
  margin-left:20px;
}
.inputBox {
  width: 100%;
  height: 40px;
  border: 1px solid cornflowerblue;
  color: cornflowerblue;
  border-radius: 20px;
  position: relative;
  text-align: center;
  line-height: 40px;
  overflow: hidden;
  font-size: 16px;
}
.inputBox input {
  width: 114%;
  height: 40px;
  opacity: 0;
  cursor: pointer;
  position: absolute;
  top: 0;
  left: -14%;
}
.imgBox {
  text-align: center;
}
.imgContainer {
  border: 1px solid rgba(0, 0, 0, 0.3);
  display: inline-block;
  width: 45%;
  height: 150px;
  margin-left: 1%;
  border-radius: 10px;
  overflow: hidden;
  position: relative;
  margin-top: 20px;
  box-sizing: border-box;
}

.imgBox .background-box {
  border: 1px solid rgba(0, 0, 0, 0.3);
  margin-left: 0;
  margin-right: 0;
  margin-top: 0;
  margin-bottom: 10px;
  width: 100%;
}
.imgContainer img {
  width: 100%;
  height: 100%;
  cursor: pointer;
}
.imgContainer p {
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  height: 30px;
  background: rgba(0, 0, 0, 0.5);
  text-align: center;
  line-height: 30px;
  color: white;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  display: none;
}
.imgContainer p.background-notice {
  top: 0;
  bottom: 0;
  margin: auto;
  color: #333;
  background-color: #fff;
  font-size: 20px;
  display: block;
}
.imgContainer p.set-background {
  position: absolute;
  top: -1px;
  left: 0;
  width: 100%;
  height: 30px;
  background: rgba(0, 0, 0, 0.5);
  text-align: center;
  line-height: 30px;
  color: white;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  display: none;
}
.imgContainer:hover p {
  display: block;
}

.add_notice {
  margin-top: 20px;
  border-bottom: 1px solid #930;
  color: #930;
}

.btn-info,
.btn-warning {
  margin-top: 20px;
  width: 100%;
}

.c-dropdown {
  position: relative;
  display: inline-block;
  text-align: left;
}

.c-dropdown__list {
  margin: 5px 0 0 0;
  padding: 6px 0;
  list-style: none;
  position: absolute;
  top: 125%;
  left: 0;
  width: 100%;
  z-index: 9999;
  border: 1px solid rgb(184, 177, 177);
  /* opacity: 0;
  visibility: hidden; */
  border-radius: 3px;
  background: #fff;
}
.c-dropdown.is-open .c-dropdown__list {
  opacity: 1;
  visibility: visible;
  top: 100%;
}

.c-dropdown__item {
  padding: 6px 12px;
  font-size: 14px;
  line-height: 20px;
  cursor: pointer;
  color: #434a54;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.c-dropdown__item:hover {
  background-color: #e6e9ed;
}
.c-button {
  margin-left: 20px;
  margin: 0;
  border: 0;
  overflow: visible;
  font: inherit;
  text-transform: none;
  display: inline-block;
  vertical-align: middle;
  text-decoration: none;
  text-align: center;
}
.c-button:hover,
.c-button:focus {
  outline: none;
  text-decoration: none;
}
.c-button:not(:disabled) {
  cursor: pointer;
}

.c-button-dropdown {
  padding: 6px 34px 6px 12px;
  background-color: #967adc;
  color: #e6e9ed;
  font-size: 14px;
  line-height: 20px;
  min-height: 32px;
  border-radius: 3px;
}
.c-button-dropdown:hover {
  background-color: #ac92ec;
}
.c-button-dropdown:after {
  content: "";
  position: absolute;
  top: 14px;
  right: 11px;
  width: 0;
  height: 0;
  border: 5px solid transparent;
  border-top-color: #e6e9ed;
}
.sidepadding{
padding-left:15%;
padding-right:15%;
padding-top:12px;
padding-bottom:12px;
}
.sidepadding2{
padding-left:15%;
padding-right:40%;
padding-top:12px;
padding-bottom:12px;
}
.mainpadding{
border:solid 1px #636060;
padding:42px;
margin-top:42px;
margin-bottom:42px;
}
.show-tags-enter-active {
  animation: bounce-in 0.5s;
}
.show-tags-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

@media only screen and (min-width: 769px) and (max-width: 1400px) {
  .write {
    width: 95%;
  }
  .center .file {
    padding: 20px 5px;
    margin-left: 5px;
  }

  .imgContainer {
    height: 100px;
  }
}

@media only screen and (max-width: 768px) {
  .title-top .title,
  .center .markdown,
  .center .file {
    width: 100%;
  }
  .center .file,
  .c-dropdown {
    margin-top: 10px;
  }
}
</style>
