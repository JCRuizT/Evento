<template>
  <header id="header">
    <div id="title-content">
      <h1>JR</h1>
    </div>

    <ul>
      <li class="li-menu">
        <router-link to="/app/registry" class="link-menu">registo</router-link>
      </li>

      <li class="li-menu">
        <router-link to="/app/report" class="link-menu">ver informe</router-link>
      </li>
    </ul>
  </header>
</template>

<script>
export default {
  name: "app-header"
};
</script>

<style scoped>
#header {
  background-color: #fff;
  height: 60px;
  box-shadow: 0px 0px 5px #000;
  display: flex;
  justify-content: space-around;
  position: fixed;
  width: 100%;
  z-index: 9999;
  }

#title-content {
  width: 45px;
  height: 45px;
  border-radius: 100%;
  background-color: #000;
  margin-top: 8px;
  user-select: none;
  cursor: pointer;
}

h1 {
  color: #fff;
  font-size: 18px;
  position: relative;
  left: 10px;
  top: 12px;
  font-weight: bold;
}

#header ul {
  display: flex;
  justify-content: center;
  margin-top: 16px;
}
.link-menu {
  color: #1a237e;
  font-weight: bold;
  font-size: 17px;
  text-transform: uppercase;
  font-family: "Ruda", sans-serif;
  letter-spacing: 1px;
  margin-left: 10px;
}

.link-menu.router-link-active {

  border-bottom: 3px solid #000;
  transition: 0.3s ease;
}
</style>


