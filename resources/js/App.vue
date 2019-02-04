<template>
  <div id="app">
    <app-header></app-header>
    <div id="content-body" class="row">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import header from "./components/header.vue";
export default {
  name: "App",
  components: {
    "app-header": header
  }
};
</script>


<style>
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}

a,
a:hover {
  text-decoration: none;
}

ul,
ol {
  list-style: none;
}

#app {
  background-color: #f1f1f1;
  width: 100%;
  min-height: 100vh;
  height: auto;
  overflow-x: hidden;
  padding-bottom: 20px
}

#content-body{

    margin-top: 120px;
    display: flex;
    justify-content: center;
}
</style>
