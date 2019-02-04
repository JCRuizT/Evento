<template>
  <form id="form-registry" class="col-md-6" :action="action" v-on:submit.prevent="save">

    <div class="form-group">
      <label for="name">Nombre</label>
      <input
        name="name"
        v-validate="'required|alpha_spaces'"
        type="text"
        class="form-control"
        id="name"
        v-model="name"
      >
      <span
        class="input-error alert-danger"
        v-if="submitted && errors.has('name')"
      >{{ errors.first('name') }}</span>
    </div>

    <div class="form-group">
      <label for="identification_card">Cedula</label>
      <input
        type="text"
        v-validate="'required|numeric'"
        class="form-control"
        id="identification_card"
        v-model="identification_card"
        name="identification_card"
      >
      
      <span
        class="input-error alert-danger"
        v-if="submitted && errors.has('identification_card')"
      >{{ errors.first('identification_card') }}</span>
    </div>

    <div class="form-group">
      <label for="name">Fecha de nacimiento</label>
      <input
        type="date"
        v-validate="'required'"
        class="form-control"
        v-model="birthdate"
        name="birthdate"
        id="birthdate"
      >

      <span
        class="input-error alert-danger"
        v-if="age(birthdate) == false && submitted == true"
      >Error en la fecha ingresada, Debe tener de 18 años en adelante</span>
    </div>

    <div class="form-group">
      <label>Genero</label>
      <div class="radio">
        <input
          type="radio"
          name="gender"
          v-validate="'required|included:0,1,2'"
          value="0"
          v-model="gender"
        >Masculino
      </div>

      <div class="radio">
        <input type="radio" name="gender" value="1" v-model="gender">Femenino
      </div>
      <div class="radio">
        <input type="radio" name="gender" value="2" v-model="gender"> Otro
      </div>

      <span
        class="input-error alert-danger"
        v-if="submitted && errors.has('gender')"
      >{{ errors.first('gender') }}</span>
    </div>

    <input
      type="submit"
      class="btn btn-primary col-md-12"
      id="submit"
      :disabled="registed == true"
      value="Registrar"
    >
    
    <span
      v-if="success == true"
      class="input-success alert-success"
    >Registro insertado correctamente</span>
    <span
      v-if="error == true"
      class="input-success alert-danger"
    >Ha ocurrido un error, revisa que los campos esten correctamente</span>
  </form>
</template>


<script>
export default {
  name: "registry",
  data() {
    return {
      action: "/api/asistentes",
      name: "",
      identification_card: "",
      birthdate: "",
      gender: "",
      submitted: false,
      error: false,
      success: false,
      registed: false,
      axios: window.axios
    };
  },
  methods: {
    save(event) {
      this.submitted = true;

      this.$validator.validate().then(valid => {
        if (valid) {
          if (this.age(this.birthdate) == false) {
          } else {
            axios({
              method: "post",
              url: this.action,
              data: {
                name: this.name,
                identification_card: this.identification_card,
                birthdate: this.birthdate,
                gender: this.gender
              }
            })
              .then(result => {
                const data = result.data;
                console.log(data);
                if (data.error) {
                  this.error = true;
                  setTimeout(() => {
                    this.error = false;
                  }, 2000);
                } else {
                  this.success = true;
                  this.registed = true;
                  document.getElementById("form-registry").reset();
                  setTimeout(() => {
                    this.name = "";
                    this.birthdate = "";
                    this.gender = "";
                    this.identification_card = "";
                    this.success = false;
                    this.submitted = false;
                    this.registed = false;
                  }, 2000);
                }
              })
              .catch(err => {
                console.log(err);
              });
          }
        }
      });
    },

    age(date) {
      var age = new Date(date);
      var now = new Date();

      var ageYear = age.getFullYear();
      var nowYear = now.getFullYear();

      var ageMonth = age.getMonth();
      var nowMonth = now.getMonth();

      var ageDay = age.getDay();
      var nowDay = now.getDay();

      if (nowYear - ageYear >= 18) {
        return true;
      } else if (nowYear - ageYear == 17) {
        if (nowMonth > ageYear) {
          return true;
        } else if (nowMonth == ageMonth) {
          if (nowDay >= ageYear) {
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
  }
};
</script>

<style scoped>
input[type="date"]::-webkit-clear-button {
  display: none;
}

input[type="date"]::-webkit-inner-spin-button {
  display: none;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  color: #2c3e50;
}

input[type="date"] {
  appearance: none;
  -webkit-appearance: none;
  color: #95a5a6;
  font-family: "Helvetica", arial, sans-serif;
  font-size: 18px;
  background: #ecf0f1;
  padding: 5px;
  display: inline-block !important;
  visibility: visible !important;
  text-transform: uppercase;
}

input[type="date"],
focus {
  color: #000;
}

#form-registry {
  background-color: #fff;
  padding: 50px;
}

.input-error,
.input-success {
  display: block;
  margin-top: 10px;
  padding: 10px;
  border-radius: 7px;
  text-align: center;
}
</style>

