
var myComponent = Vue.extend({
  props:['count'],
  data:{
    hoge:0
  },
  template:"#template"
})

Vue.component('my-component', myComponent)

new Vue({
  el: '#app',
  data: {
    items:[
      {hoge:""}
    ],
    message:""
  },
  methods:{
    route:function(){
      var test = {hoge:this.message};
      this.items.push(test);
      $(".textbox_add").val("");
    }
  }
})
