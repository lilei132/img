<template>
    <div class="main">
<el-tabs :tab-position="tabPosition" type="border-card" class="main">
	<el-tab-pane>
		<span slot="label"></i> 个人信息</span>
		<div> <el-card class="box-card">
			<div>
				<el-row :gutter="20">
					<el-col :span="6">
						<div >
							<el-avatar :src="useravatar"></el-avatar>
							
            				<el-button type="info" plain size="mini" @click="avatarchange = true">上传头像</el-button>
						</div>
					</el-col>
					<el-col :span="12">
						<div>
							<el-row id='1'>用户ID：{{ user.user_id }}</el-row>
							<el-row :gutter="20"><el-col :span="6"><span class="text-999">人气:</span>
								<span class="font-weight-bold">  0</span></el-col>
								<el-col :span="6"><span class="text-999" style="display:inline;font-size=12px">作品:</span>
									<a href="#" class="font-weight-bold" style="display:inline"> 0</a>
								</el-col>
								<el-col :span="6"><span class="text-999">关注:</span>
									<a href="/#" class="font-weight-bold">  0</a></el-col>
									<el-col :span="6"><span class="text-999">粉丝:</span>
										<a href="/#" class="font-weight-bold"> 0</a></el-col>
									</el-row>
								</div>
							</el-col>
						</el-row>
					</div>
				<el-divider></el-divider>
						<div>
							<el-row>
								<div> 个人信息：
								 <el-button type="info" plain size="mini" @click="dialogFormVisible = true">修改</el-button>

								</div></el-row>
								<el-row>
									<el-col :span="4">邮箱：</el-col>
									<el-col :span="10" >{{ user.user_email }}</el-col>
								</el-row>
								<el-row>
									<el-col :span="4">用户名：</el-col>
									<el-col :span="10" >{{ user.user_name }}</el-col>
								</el-row>
								
						</div> 
					<el-divider></el-divider>
						<div>
							<el-row>
								<div> 基础资料 ：
								 <el-button type="info" plain size="mini" 
								 @click="dialogTableVisible = true">修改</el-button>

								</div></el-row>
								<el-row>
									<el-col :span="4">地址：</el-col>
									<el-col :span="10" >{{ user.user_address }}</el-col>
								</el-row>
								<el-row>
									<el-col :span="4">支付方式：</el-col>
									<el-col :span="10" >{{ user.payway }}</el-col>
								</el-row>
								
						</div> 
                   <el-divider></el-divider>  	
                   <div>
							<el-row>
								<div>修改密码：
									<el-button type="info" plain size="mini" 
								 @click="dialogpswVisible = true">修改</el-button> </div></el-row>
						</div>
		        <el-divider></el-divider> 			
						<div>
							<el-row>
								<div>上传作品：<el-button size="small" type="primary" @click="upload()">点击上传</el-button></span> </div></el-row>
						</div>
		        <el-divider></el-divider> 				
						<div>
							<el-row>
								<div> 账号类型：<span v-show="radio==1">普通用户</span> 
									<span v-show="radio==2">企业用户</span>
								</div></el-row>
						</div>
					</el-card></div>
				</el-tab-pane>
    <el-tab-pane>
    <span slot="label"> 个人作品</span>
           <p v-if="list2===null">暂无！</p>
			<el-col :span="6" v-for="img in list2" :key="img.a_id" class="imgcard" style="padding:7px">
				<el-card :body-style="{ padding: '0px' }"  shadow="never" >
					<el-image :src="img.i_img" fit='cover' style="height:150px"></el-image>
										<div style="padding: 7px;">
						<span style="font-size:12px" @click="showImgDetail(img.a_id)">{{img.i_title}}</span>
					</div><div class="bottom clearfix" style="padding:5px ">
						<span style="font-size:12px">创建于：{{img.create_time}}</span>
					</div>
					<i class="delete glyphicon glyphicon-trash" @click="confirmDel2(img.i_id)"></i>
				</el-card>
      <el-dialog :visible.sync="visible"
        width="30%"
        style="text-align:center">
            <div class="title">确认要删除该图组？</div>
            <div class="content">
              <button type="button" class="btn btn-warning" @click="delimg()">确认</button>
              <button type="button" class="btn btn-info" @click="visible=false">取消</button>

        </div>
    </el-dialog>

			</el-col>
  </el-tab-pane>  
  <el-tab-pane>
    <span slot="label"></i> 我的关注</span>
    <el-col :span="6" v-for="follow in list3" :key="follow.user_id" class="imgcard" style="padding:15px;">
				<el-card :body-style="{ padding: '0px' }"  shadow="never" >
					 <el-col><el-avatar :src="follow.user_avatar" ></el-avatar></el-col>
										<div style="padding: 7px;">
					<el-row ><el-col :offset="10"><span style="font-size:12px"><a @click="showauthor(follow.user_id)">{{follow.user_name}}</a></span></el-col></el-row>

					</div>
					<el-row>
						<el-col :offset="3">
					<div class="bottom clearfix" style="padding:5px ">
						<span class="font-12" style="margin-right: 1rem !important;">人气：7923</span>
						<span class="font-12" style="margin-right: 1rem !important;" >作品：72</span>
					</div>
				</el-col>
				</el-row>
				
				</el-card>
			</el-col>
  </el-tab-pane>
  <el-tab-pane>
    <span slot="label">我发布的文章</span>
 <div class="editor">
    <div class="table">
      <table cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>标题</th>
            <th>发文时间</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="article in list" :key="article.a_id">
            <td width="5%">{{article.a_id}}</td>
            <td @click="showArticle(article.a_id)">{{article.a_title}}</td>
            <td width="15%">{{article.create_time}}</td>
            <td width="10%">
              <label class="el-switch">
                <input
                  @click="publish(article.a_id)"
                  type="checkbox"
                  name="switch"
                  :checked="article.published==1?'checked':null "
                >
                <span class="el-switch-style"></span>
              </label>
            </td>
            <td width="15%">
<!--               <i class="edit glyphicon glyphicon-edit" @click="getOneArticle(article.a_id)"></i> -->
              <i class="delete glyphicon glyphicon-trash" @click="confirmDel(article.a_id)"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <el-dialog :visible.sync="dialog1"
  width="30%"
  style="text-align:center">
            <div class="title">确认要删除该文章？</div>
            <div class="content">
              <button type="button" class="btn btn-warning" @click="delArticle()">确认</button>
              <button type="button" class="btn btn-info" @click="dialog1=false">取消</button>

        </div>
    </el-dialog>
    </div>
  </div>

  </el-tab-pane>


  </el-tabs>
<!-- //改名字 -->

  <el-dialog title="修改您的基础信息" :visible.sync="dialogFormVisible">
  <el-form :model="form">
    <el-form-item label="您的新名字" :label-width="formLabelWidth">
      <el-input v-model="form.name" autocomplete="off"></el-input>
    </el-form-item>
  </el-form>
  <div slot="footer" class="dialog-footer">
  	<el-button @click="dialogFormVisible = false">取 消</el-button>
    <el-button type="primary" @click="updata() " >确 定</el-button>
  </div>
</el-dialog>

<!-- 改基础信息 -->
  <el-dialog title="修改您的基础资料" :visible.sync="dialogTableVisible">
  <el-form :model="detail">
    <el-form-item label="地址" :label-width="formLabelWidth">
      <el-input v-model="detail.address" autocomplete="off"></el-input>
    </el-form-item>
  </el-form>
  <div slot="footer" class="dialog-footer">
  	<el-button @click="dialogFormVisible = false">取 消</el-button>
    <el-button type="primary" @click="updatedetail()">确 定</el-button>
  </div>
</el-dialog>
<!-- 改密码 -->
  <el-dialog title="修改您的基础信息" :visible.sync="dialogpswVisible">
   <el-form ref="dataForm" :rules="rules" :model="dataForm" status-icon label-position="left" label-width="100px" style="width: 400px; margin-left:50px;">
      <el-form-item label="原密码" prop="oldPassword">
        <el-input v-model="dataForm.oldPassword" type="password"/>
      </el-form-item>
      <el-form-item label="新密码" prop="newPassword">
        <el-input v-model="dataForm.newPassword" type="password" auto-complete="off"/>
      </el-form-item>
      <el-form-item label="确认密码" prop="newPassword2">
        <el-input v-model="dataForm.newPassword2" type="password" auto-complete="off"/>
      </el-form-item>
    </el-form>
  <div slot="footer" class="dialog-footer">
  	<el-button @click="dialogpswVisible = false">取 消</el-button>
    <el-button type="primary" @click="change() " >确 定</el-button>
  </div>
</el-dialog>
<!-- 更改头像 -->
  <el-dialog title="修改您的头像" :visible.sync="avatarchange">
  <el-form :model="form">
    <el-form-item :label-width="formLabelWidth">

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
              <img :src="img.url" alt style="width:68px">
              <p @click="remove(index)">删除</p>
            </div>
          </div>
          <button type="button" class="btn btn-info" @click="upImgs">立即上传</button>
            <div class="imgBox" v-show="article.images.length">
            <p class="add_notice">加入正文</p>
            <div v-for="img in article.images" :key="img.image" class="imgContainer">
              <img :src="img.image" style="width:48px"alt>
              <el-button type="primary" @click="upavatar(img) " >确 定</el-button>
            </div>
          </div>
          
    </el-form-item>
  </el-form>
  <div slot="footer" class="dialog-footer">
  	<el-button @click="avatarchange = false">取 消</el-button>
    <el-button type="primary" @click="upavatar() " >确 定</el-button>
  </div>
</el-dialog>
</div>

</template>
<script type="text/ecmascript-6">
import {changeName,changeDetail,changePassword,findFollow,updateavatar} from '@/api/user'
import { mapMutations, mapGetters } from 'vuex'
import { getTitleList, changePublish, delArticle } from '@/api/article'
import {getimgTitleList,delImg} from '@/api/Img'
import { upBase64 } from '@/api/file'
export default {
	data(){
		var validatePass = (rule, value, callback) => {
			if (value === '') {
				callback(new Error('请输入密码'))
			} else {
				callback()
			}
		}
		var validatePass2 = (rule, value, callback) => {
			if (value === '') {
				callback(new Error('请再次输入密码'))
			} else if (value !== this.dataForm.newPassword) {
				callback(new Error('两次输入密码不一致!'))
			} else {
				callback()
			}
		}
		return {
			tabPosition: 'left',
			url:'https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg',
			//src:'',
			dialogTableVisible: false,
			dialogFormVisible: false,
			dialogpswVisible: false,
			avatarchange:false,
			form: {
				id: '',
				name: '',
			},
			detail:{
				address:'',
				radio:'1',

			},
			formLabelWidth: '120px',
			dataForm: {
				oldPassword: '',
				newPassword: '',
				newPassword2: ''
			},
			rules: {
				oldPassword: [
				{ required: true, message: '旧密码不能为空', trigger: 'blur' }
				],
				newPassword: [
				{ required: true, message: '新密码不能为空', trigger: 'blur' },
				{ validator: validatePass, trigger: 'blur' }
				],
				newPassword2: [
				{ required: true, message: '确认密码不能为空', trigger: 'blur' },
				{ validator: validatePass2, trigger: 'blur' }
				]
			},
			//个人发布文章
			dialog1: false,
			visible: false,
            id: null,
            id2: null,
            published: null,
            list: [],
            list2: [],
            list3:[],	
            article:{
            	images:[],
            	a_img: '',
            	user_id: 0,
            },
            imgs: [],
            images: [], // 传递到后台的图片地址
            savedImgs: [],
            radio:'1',

		}
		
	},
	computed: {
    ...mapGetters(['user']),
    useravatar(){
    	return this.user.user_avatar
    },
  },
//   created () {
//     console.log(this.detail.radio) // 由于getters已经通过computed挂载到当前实例,所以你不需要再通过this.$store.getters的方法去访问
// },
	methods: {
		upload () {
		this.$router.push('/imgupload')
		},

		updata (user){
			 //id1=getElementById("1").value

			this.dialogFormVisible = false
			var id1=this.user.user_id
			let id = { id: id1 }
			id.name=this.form.name
			changeName(id).then(()=>{
				this.$notify.success({
					title: '成功',
					message: '更新成功',


				});
				//parent.location.reload();
			}).catch(response => {
				this.$notify.error({
					title: '失败',
					message: response.data.msg
				})
			})
			this.user.user_name=this.form.name
		},
		updatedetail(user){
			this.dialogTableVisible = false
			var id1=this.user.user_id
			let id = { id: id1 }
			id.address=this.detail.address
			id.gender=this.detail.radio
			changeDetail(id).then(() => {
				this.$notify.success({
					title: '成功',
					message: '更新成功'
				})
			}).catch(response => {
				this.$notify.error({
					title: '失败',
					message: response.data.msg
				})
			})
			this.user.user_address=this.detail.address
			this.radio=this.detail.radio
		},
	cancel() {
      this.dataForm = {
        oldPassword: '',
        newPassword: '',
        newPassword2: ''
      }
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    },
    change() {
      this.$refs['dataForm'].validate((valid) => {
        if (!valid) {
          return
        }
        var id1=this.user.user_id
		let id3 = { id: id1 }
		id3.password=this.dataForm.oldPassword
		id3.newpassword=this.dataForm.newPassword
        changePassword(id3).then(response => {
          this.$notify.success({
            title: '成功',
            message: '修改密码成功'
          })
        }).catch(response => {
          this.$notify.error({
            title: '失败',
            message: response.data.errmsg
          })
        })
      })
    },
    getList(ID) {
      getTitleList(ID).then(response => {
        this.list = response.data.data
      })
    },
      showArticle(id) {
      this.$router.push({
        name: 'article', params: { id }
      })
    },
    confirmDel(id) {
      this.dialog1 = true
      this.id = id
    },
    delArticle() {
      this.dialog1 = false
      const data = { id: this.id }
      delArticle(data).then(response => {
        for (const v of this.list) {
          if (v.a_id === this.id) {
            const index = this.list.indexOf(v)
            this.list.splice(index, 1)
            break
          }
        }
      })
    },
    //图片组的操作
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
    confirmDel2(id) {
      this.visible = true
      this.id2 = id
    },
    delimg() {
      this.visible = false
      const data = { id: this.id2 }
      delImg(data).then(response => {
        for (const v of this.list2) {
          if (v.i_id === this.id) {
            const index = this.list2.indexOf(v)
            this.list2.splice(index, 1)
            break
          }
        }
      })
    },
    //上传头像
    upImgs: function() {
      if (this.imgs.length === 0) {
        this.SHOW_ALERT('请选择要上传图片')
        return
      }
      const data = {
        imgs: this.images,
        path: 'article',
        id: this.user.user_id
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
    },
    fileImage(e) {
      const _this = this
      const file = e.target.files
      // console.log(file[0].name);
      if (this.imgs.length > 1 || this.imgs.length + file.length > 9) {
        this.SHOW_ALERT('上传一张头像就够了')
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

    upavatar(img){
    	var id4=this.user.user_id
    	const form3={id:id4}
    	form3.user_avatar=img.image
    	updateavatar(form3).then(response => {
    		this.user.user_avatar.a_img = response.data.data
        this.$notify.success({
            title: '成功',
            message: '修改头像成功'
          })
      })
    },
    //关注者列表
    findFollowlist(id){
    	findFollow(id).then(response => {
        this.list3 = response.data.data
      })
		},

	showauthor(id) {
      this.$router.push({
        name: 'author', params: { id }
      })
    },
    },
created: function() {

  },
  mounted: function() {	
  	const id=this.user.user_id
  	var id2={id:this.user.user_id}
  	this.radio=this.user.user_identity
    this.getList(id)
    this.getimgList(id)
    this.findFollowlist(id2)
}

}




    

</script>
<style>
.border-bottom{
	border-bottom: 1px solid rgba(225,225,225,0.5) !important;
    margin-bottom: 1.5rem !important;
    margin-top: 1.5rem !important;
    width:604px;
}
.main{
  width: 100%;
  min-height: 800px;
}
.font-12{
	font-size:12px
}
.juzhong{
	position:absolute;
    top:50%;
    left:50%;
}
</style>