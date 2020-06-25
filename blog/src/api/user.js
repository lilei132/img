import request from '@/utils/request'

export function fetchList(query) {
  return request({
    url: '/admin/user/getList',
    method: 'get',
    params: query
  })
}

export function findUser(query) {
  return request({
    url: '/admin/user/getOne',
    method: 'get',
    params: query
  })
}

export function changeName(data) {
  return request({
    url: '/admin/user/changeName',
    method: 'post',
    data
  })
}

export function changeDetail(data) {
  return request({
    url: '/admin/user/changeDetail',
    method: 'post',
    data
  })
}
export function changePassword(data) {
  return request({
    url: '/admin/user/changePassword',
    method: 'post',
    data
  })
}
export function findFollow(data) {
  return request({
    url: '/blog/Follow/getfollowList',
    method: 'post',
    data
  })
}

export function updateavatar(data) {
  return request({
    url: '/admin/user/changeName2',
    method: 'post',
    data
  })
}
export function getOneavatar(data) {
  return request({
    url: '/admin/user/getOneavatar',
    method: 'post',
    data
  })
}
