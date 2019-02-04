<template>
  <ul class="list-group col-md-6 col-sm-9">
    <li
      class="list-group-item d-flex justify-content-around row"
      v-for="(asistent,index) in listAsistent"
    >

      <div class="col-md-8">
        <span class="name">{{asistent.name}}</span>
      </div>
      <div class="col-md-4">
        <button
          :disabled="ClickEliminated == true"
          class="delete btn btn-danger"
          v-on:click="destroy(asistent,index)"
        >Eliminar</button>
        <button
          class="btn btn-warning"
          v-on:click="datails(asistent.identification_card)"
        >Ver destalles</button>
      </div>

      <div v-if="id == asistent.identification_card" id="table-details">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Identificacion</th>
              <th scope="col">Genero</th>
              <th scope="col">Edad</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ asistent.identification_card}}</td>
              <td>{{asistent.gender == 0 ? "Masculino" : asistent.gender == 1 ? "Femenino": "Otro"}}</td>

              <td>{{age(asistent.birthdate)}}</td>
            </tr>
          </tbody>
        </table>
      </div>

    </li>
    <li v-if="listAsistent.length == 0"class="list-group-item d-flex justify-content-around row">No existen asistentes</li>
  </ul>
</template>

<script>
export default {
  name: "report",
  data() {
    return {
      read: "/api/asistentes",
      listAsistent: [],
      id: null,
      click: false,
      ClickEliminated: false
    };
  },

  methods: {
    datails(id) {
      if (this.click == false) {
        this.id = id;
        this.click = true;
      } else {
        this.id = null;
        this.click = false;
        this.id = false;
      }
    },

    age(date) {
      var age = new Date(date);
      var now = new Date();

      var ageYear = age.getFullYear();
      var nowYear = now.getFullYear();

      return nowYear - ageYear;
    },
    destroy(asistent, index) {
      this.ClickEliminated = true;
      const prop = confirm("Desea eliminar este Asistente");

      if (prop) {
        axios({
          method: "delete",
          url: "/api/asistentes/" + asistent.id
        })
          .then(result => {

            this.listAsistent.splice(index, 1);
            this.ClickEliminated = false;
          })
          .catch(err => {
            this.ClickEliminated = false;
            alert("A ocurrido un error");
          });
      } else {
        this.ClickEliminated = false;
      }
    }
  },

  created() {
    axios({
      method: "get",
      url: this.read
    })
      .then(result => {
            for(var i=0; i<result.data.length; i++){

                 this.listAsistent.push(result.data[i])

            }

            
      })
      .catch(err => {
        alert("A ocurrido un error");
      });
  }
};
</script>

<style scoped>
.name {
  margin-top: 8px;
}

#table-details {
  margin-top: 20px;
}
</style>


