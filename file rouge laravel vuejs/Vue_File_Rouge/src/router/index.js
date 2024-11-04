import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import RegisterView from "../views/Auth/RegisterView.vue";
import LoginView from "../views/Auth/LoginView.vue";
import CreateView from "@/views/Posts/CreateView.vue";
import ShowView from "@/views/Posts/ShowView.vue";
import UpdateView from "@/views/Posts/UpdateView.vue";
import CreateUserView from "@/views/Posts/CreateUserView.vue";
import UserManagement from "@/views/Posts/UserManagement.vue";
import { useAuthStore } from "@/stores/auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/register",
      name: "register",
      component: RegisterView,
      meta: { guest: true },
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
      meta: { guest: true },
    },
    {
      path: "/create",
      name: "create",
      component: CreateView,
      meta: { auth: true },
    },
    {
      path: "/posts/:id",
      name: "show",
      component: ShowView,
    },
    {
      path: "/posts/update/:id",
      name: "update",
      component: UpdateView,
      meta: { auth: true },
    },
    {
      path: "/create-user", // Define the route for creating a user
      name: "createUser",
      component: CreateUserView,
      meta: { auth: true, admin: true }, // Only accessible by authenticated admins
    },
    {
      path: '/admin/users',
      name: 'UserManagement',
      component: UserManagement,
      meta: { auth: true, admin: true },

    },
  ],
});

router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  await authStore.getUser();

  if (authStore.user && to.meta.guest) {
    return { name: "home" };
  }

  if (!authStore.user && to.meta.auth) {
    return { name: "login" };
  }
  if (to.meta.admin && authStore.role !== "admin") {
    return { name: "home" }; // Redirect non-admin users trying to access admin routes
  }
})


export default router
