<template>
    <div>
<el-tabs :tab-position="tabPosition" type="border-card">
	<el-tab-pane>
		<span slot="label"><i class="el-icon-date"></i> 个人信息</span>
		<div> <el-card class="box-card">
			<div>
				<el-row :gutter="20">
					<el-col :span="6">
						<div >
							<el-avatar :src="useravatar"></el-avatar>
						</div>
					</el-col>
					<el-col :span="12">
						<div>
							<el-row id='1'>{{ user.user_id }}</el-row>
							<el-row :gutter="20"><el-col :span="6"><span class="text-999">人气:</span>
								<span class="font-weight-bold">  0</span></el-col>
								<el-col :span="6"><span class="text-999" style="display:inline;font-size=12px">作品:</span>
									<a href="#" class="font-weight-bold" style="display:inline">  0</a>
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
							<div 
							<el-row><div> 账号类型：<span class=" ">普通用户（无法发布作品,申请后获得权限）</span> </div></el-row>
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
								<div> 账号类型：<span class=" ">普通用户（or企业用户）</span> </div></el-row>
						</div>
					</el-card></div>
				</el-tab-pane>
    <el-tab-pane>
    <span slot="label"><i class="el-icon-date"></i> 个人作品</span>
			<el-col :span="6" v-for="img in list2" :key="img.a_id" class="imgcard" style="padding:7px">
				<el-card :body-style="{ padding: '0px' }"  shadow="never" >
					<el-image :src="img.i_img"></el-image>
										<div style="padding: 7px;">
						<span style="font-size:12px" @click="showArticle(img.a_id)">{{img.i_title}}</span>
					</div><div class="bottom clearfix" style="padding:5px ">
						<span style="font-size:12px">创建于：{{img.create_time}}</span>
					</div>
					<i class="delete glyphicon glyphicon-trash" @click="delimg(img.i_id)"></i>
				</el-card>
	<transition name="show-del">
        <div class="mask" v-if="confirm_del2" @click="confirm_del2=false">
          <div class="alert" @click="stopProp">
            <div class="title">确认要删除该文章？</div>
            <div class="content">
              <button type="button" class="btn btn-warning" @click="delArticle2()">确认</button>
              <button type="button" class="btn btn-info" @click="confirm_del2=false">取消</button>
            </div>
          </div>
        </div>
      </transition>

			</el-col>
  </el-tab-pane>  
  <el-tab-pane>
    <span slot="label"><i class="el-icon-date"></i> 我的关注</span>
    <el-col :span="6" v-for="(o, index) in 16" :key="o" class="imgcard" style="padding:15px;">
				<el-card :body-style="{ padding: '0px' }"  shadow="never" >
					 <el-col><el-avatar src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" ></el-avatar></el-col>
										<div style="padding: 7px;">
					<el-row ><el-col :offset="10"><span style="font-size:12px">飞天敦煌</span></el-col></el-row>

					</div>
					<el-row>
						<el-col :offset="3">
					<div class="bottom clearfix" style="padding:5px ">
						<span class="font-12" style="margin-right: 1rem !important;">人气：7923</span>
						<span class="font-12" style="margin-right: 1rem !important;" >作品：72</span>
					</div>
				</el-col>
				</el-row>
				<el-row style="padding-bottom:7px"><el-col :offset="9	">  <el-button size="mini" round>关注</el-button></el-col></el-row>
				</el-card>
			</el-col>
  </el-tab-pane>
  <el-tab-pane>
    <span slot="label"><i class="el-icon-date"></i> 我发布的文章</span>
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
      <transition name="show-del">
        <div class="mask" v-if="confirm_del" @click="confirm_del=false">
          <div class="alert" @click="stopProp">
            <div class="title">确认要删除该文章？</div>
            <div class="content">
              <button type="button" class="btn btn-warning" @click="delArticle()">确认</button>
              <button type="button" class="btn btn-info" @click="confirm_del=false">取消</button>
            </div>
          </div>
        </div>
      </transition>
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
   <el-form-item label="性别" :label-width="formLabelWidth">
  <el-radio-group v-model="detail.radio">
    <el-radio :label="1">男</el-radio>
    <el-radio :label="2">女</el-radio>
  </el-radio-group>
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
    </div>
</template>
<script type="text/ecmascript-6">
import {changeName,changeDetail,changePassword} from '@/api/user'
import { mapMutations, mapGetters } from 'vuex'
import { getTitleList, changePublish, delArticle } from '@/api/article'
import {getimgTitleList,delImg} from '@/api/Img'
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
			confirm_del: false,
			visible: false,
            id: null,
            id2: null,
            published: null,
            list: [],
            list2: []
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
					message: '更新成功'
				})
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
      this.confirm_del = true
      this.id = id
    },
    delArticle() {
      this.confirm_del = false
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
      this.id2 = id
    },
    delimg(id) {
      //this.confirm_del = false
      const data = { id: id }
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
    },
created: function() {

  },
  mounted: function() {	
  	const id=this.user.user_id
    this.getList(id)
    this.getimgList(id)
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
.font-12{
	font-size:12px
}
.juzhong{
	position:absolute;
    top:50%;
    left:50%;
}
</style>