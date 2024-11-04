<template>
  <div>
    <h1>User Management</h1>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role }}</td>
          <td>
            <button @click="editUser(user)">Edit</button>
            <button @click="deleteUser(user.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router'; // Import the router

const users = ref([]);
const authStore = useAuthStore();
const router = useRouter(); // Initialize the router
onMounted(async () => {
  try {
    const token = Cookies.get('token');
    if (!token) {
      router.push({ name: 'Login' });
      return;
    }

    const response = await fetch("/api/users", {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    users.value = data;
  } catch (error) {
    console.error('Error fetching users:', error);
  }
});


// onMounted(async () => {
//   try {
//     const response = await fetch("/api/users", {
//       method: "GET",
//       headers: {
//         Authorization: `Bearer ${authStore.token}`,
//       },
//     });

//     if (response.status === 401) {
//       console.log('Unauthorized, please log in again');

//       // Redirect to login page if token is invalid
//       router.push({ name: 'Login' });
//     } else {
//       const data = await response.json();
//       users.value = data;
//     }
//   } catch (error) {
//     console.error('Error fetching users:', error);
//   }
// });

const deleteUser = async (userId) => {
  if (confirm('Are you sure you want to delete this user?')) {
    await fetch(`/api/users/${userId}`, {
      method: 'DELETE',
      headers: {
        Authorization: `Bearer ${authStore.token}`,
      },
    });
    users.value = users.value.filter(user => user.id !== userId);
  }
};
</script>
