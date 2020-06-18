
import { getList } from '@/api/Img'

const img = {

  state: {
    imgList: [],
    listInfo: {
      page: 1,
      limit: 10,
      userID: '',
      tagID: ''
    }
  },
  mutations: {
    SET_IMG_LIST(state, list) {
      state.imgList = list
    },
    SET_IMG_LIST_INFO(state, obj) {
      if (typeof obj.page !== 'undefined') {
        state.listInfo.page = obj.page
      }
      if (typeof obj.limit !== 'undefined') {
        state.listInfo.limit = obj.limit
      }
      if (typeof obj.userID !== 'undefined') {
        state.listInfo.userID = obj.userID
      }
      if (typeof obj.tagID !== 'undefined') {
        state.listInfo.tagID = obj.tagID
      }
    }
  },
  actions: {
    getImgList({ commit, state }) {
      getList(state.listInfo).then(response => {
        const list = response.data.data.data
        commit('SET_IMG_LIST', list)
      })
    }
  }
}

export default img
