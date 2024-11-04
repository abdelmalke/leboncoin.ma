<!-- <template>
    <div>
      <h1>Create New User</h1>
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="formData.name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="formData.email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="formData.password" required />
        </div>
        <div>
          <label for="role">Role:</label>
          <select id="role" v-model="formData.role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit">Create User</button>
      </form>
  
      <div v-if="errors">
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useAuthStore } from '@/stores/auth';
  
  const authStore = useAuthStore();
  
  const formData = ref({
    name: '',
    email: '',
    password: '',
    role: 'user', 
  });
  
  const errors = ref([]);
  
  const submitForm = async () => {
    await authStore.createUser(formData.value);
    errors.value = authStore.errors;
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
   -->
   <template>
    <div>
      <h1>Create New User</h1>
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="formData.name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="formData.email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="formData.password" required />
        </div>
        <div>
  <label for="password_confirmation">Confirm Password:</label>
  <input type="password" id="password_confirmation" v-model="formData.password_confirmation" required />
</div>
        <div>
          <label for="role">Role:</label>
          <select id="role" v-model="formData.role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>


          </select>
        </div>
        <button type="submit">Create User</button>
      </form>
  
      <div v-if="variable && variable.length">
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>

        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useAuthStore } from '@/stores/auth';
  
  const authStore = useAuthStore();
  
  const formData = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'user',
  });
  
  const errors = ref([]);
  
  const submitForm = async () => {
    await authStore.createUser(formData.value);
    errors.value = authStore.errors;
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  