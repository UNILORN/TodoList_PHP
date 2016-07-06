<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="./jquery.js" type="text/javascript"></script>
    <title>Vue</title>
  </head>
  <body>
    <div id="app">
      <div class="tableadd">
        <button type="button" class="addbutton" value="" @click="route()">my-component</button>
      </div>
      <input class="textbox_add" type="text" v-model="message" @keyup.enter="route()">
      <my-component v-for="item in items" :count="item"></my-component>
      <template id="template">
        <p>
          {{count.hoge}}
        </p>
      </template>
    </div>
  </body>
  <script src="./vue.js" type="text/javascript"></script>
</html>
