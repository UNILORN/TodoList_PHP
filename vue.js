
var myComponent = Vue.extend({
  props:['count'],
  data:{
    hoge:0
  },
  template:"#template"
})

Vue.component('my-component', myComponent)

var TOP = new Vue({
  el: '#app',
  data: {
    items:[
      {hoge:"test"}
    ],
    message:""
  },
  methods:{
    route:function(){
      var test = {hoge:this.message};
      this.items.push(test)
    }
  }
})
