<template>
    <div>

    	<el-row >
    		<el-image
      style="width: 100%; height: 100%"
      :src="src"
      ></el-image>
    	</el-row>
    	<el-row class="sidepadding">
    		<el-steps :active="active" finish-status="success">
  <el-step title="步骤 1" description="这里是作品上传页面">
  </el-step>
  <el-step title="步骤 2" description="点击上传按钮，上传您的作品">
  </el-step>
  <el-step title="步骤 3" description="上传成功，等待审核"></el-step>
</el-steps>

<el-button style="margin-top: 12px;" @click="next">下一步</el-button>
</el-row>
    <el-row class="sidepadding">
    	<el-col class="mainpadding">
          <div class="inputBox">
            <input
              type="file"
              @change="fileImage"
              title="请选择图片"
              id="file"
              multiple
              accept="image/png, image/jpg, image/gif, image/JPEG"
            >点击选择图片
          </div>
          <div class="imgBox" v-show="imgs.length">
            <div v-for="(img,index) in imgs" :key="img.name" class="imgContainer">
              <img :src="img.url" alt>
              <p @click="remove(index)">删除</p>
            </div>
          </div>
          <button type="button" class="btn btn-info" @click="upImgs">立即上传</button>
</el-col>
</el-row>
    </div>
</template>
<script type="text/ecmascript-6">
import { mapMutations, mapGetters } from 'vuex'
import { upBase64 } from '@/api/file'
  export default {
    data() {
      return {
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
methods:{
   addImgArticle(img) {
      const content = this.article.a_content
      this.article.a_content = content + '![](' + img.image.replace(/\\/g, '/') + ')'
    },
    setBackground(img) {
      this.article.a_img = img.image
    },
    fileImage(e) {
      const _this = this
      const file = e.target.files
      // console.log(file[0].name);
      if (this.imgs.length > 9 || this.imgs.length + file.length > 9) {
        this.SHOW_ALERT('图片超过9九张，请分多次上传')
        return
      }
      for (let i = 0; i < file.length; i++) {
        if (this.imgs.length > 0) {
          for (let j = 0; j < this.imgs.length; j++) {
            if (file[i].name === this.imgs[j].name) {
              this.SHOW_ALERT('请不要选择重复图片')
              return
            } else {
              continue
            }
          }
        }
        const imgSize = file[i].size / 1024
        if (imgSize > 500) {
          this.SHOW_ALERT('请上传大小不要超过500KB的图片')
          continue
        } else {
          const reader = new FileReader()
          reader.readAsDataURL(file[i]) // 读出 base64
          reader.onloadend = function() {
            // 图片的 base64 格式, 可以直接当成 img 的 src 属性值
            const dataURL = reader.result
            const obj = {}
            obj.url = dataURL
            obj.name = file[i].name
            _this.imgs.push(obj) // 将base64图片数据存入预览用的数组
            _this.images.push(dataURL) // 将base64图片数据存入发送服务端用的数组
          }
        }
      }
    },
    upImgs: function() {
      if (this.imgs.length === 0) {
        this.SHOW_ALERT('请选择要上传图片')
        return
      }
      const data = {
        imgs: this.images,
        path: 'article'
      }
      upBase64(data).then(response => {
        const data = response.data.data
        this.imgs = []
        this.images = []
        this.savedImgs = this.savedImgs.concat(data.name)
        const images = []
        for (const v of data.path) {
          images.push({ image: v })
        }
        const oldImages = this.article.images
        this.article.images = oldImages.concat(images)
      })
    },
    remove: function(index) {
      this.imgs.splice(index, 1)
      this.images.splice(index, 1)
    }
  },
   computed: {
    ...mapGetters(['user'])
  },
  }

</script>
<style>
.sidepadding{
padding-left:15%;
padding-right:15%;
}
.mainpadding{
border:solid 1px #636060;
padding:42px;
margin-top:42px;
margin-bottom:42px;
}
</style>