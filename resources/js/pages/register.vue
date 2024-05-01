<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-4 mt-5">
        <div class="border border-dark rounded p-4">
          <h1 class="text-center">Register</h1>
          <p class="text-danger" v-for="error in errors" :key="error">
          </p>
          <form @submit.prevent="register">
            <div class="from-group">
              <label for="name">Name <span class="text-danger" v-if="errors.name">{{ errors.name }}</span></label>
              <input type="text" class="form-control" id="name" v-model="form.name" />
            </div>
            <div class="from-group">
              <label for="email">Email Address <span class="text-danger" v-if="errors.email">{{ errors.email
                  }}</span></label>
              <input type="email" class="form-control" id="email" v-model="form.email" />
            </div>
            <div class="from-group">
              <label for="password">Password <span class="text-danger" v-if="errors.password">{{ errors.password
                  }}</span></label>
              <input type="password" class="form-control mb-2" id="password" v-model="form.password" />
            </div>
            <div class="from-group">
              <label for="c_password">Confirm Password <span class="text-danger" v-if="errors.c_password">{{
                errors.c_password }}</span></label>
              <input type="password" class="form-control mb-2" id="c_password" v-model="form.c_password" />
            </div>
            <div class="from-group">
              <label for="c_password">Date of Birth <span class="text-danger" v-if="errors.DOB">{{ errors.DOB
                  }}</span></label>
              <input type="date" class="form-control mb-2" id="c_password" v-model="form.DOB" />
            </div>
            <div class="from-group">
              <label for="c_password">Designation</label>
              <select class="form-control mb-2" name="" id="" v-model="form.Designation_Id">
                <option v-for="des in designation"
                    :key="des.id"
                    :value="des.id">{{ des.name }}</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  setup() {
    const router = useRouter();
    const store = useStore();

    let form = reactive({
      name: "",
      email: "",
      password: "",
      c_password: "",
      DOB: "",
      Designation_Id: "",
    });

    let errors = ref([]);
    const designation = ref([]);

    const register = async () => {
      await axios
        .post("/api/register", form)
        .then((res) => {
          if (res.data.success) {
            store.dispatch("setToken", res.data.data.token);
            store.dispatch("setUserId", res.data.userid);
            router.push({ name: "Dashboard" });
          }
        })
        .catch((e) => {
          errors.value = e.response.data.message;
        });
    };

    onMounted(async () => {
      try {
        const response = await axios.get('/api/designation');
        designation.value = response.data;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    });

    return {
      form,
      register,
      errors,
      designation,
    };
  },
};
</script>
