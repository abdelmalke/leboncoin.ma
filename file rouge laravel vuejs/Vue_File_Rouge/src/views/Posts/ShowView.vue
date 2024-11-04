<!-- <script setup>
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const { getPost, deletePost } = usePostsStore();
const authStore = useAuthStore();
const post = ref(null);

onMounted(async () => (post.value = await getPost(route.params.id)));
</script>

<template>
  <main>
    <div v-if="post">
      <div class="border-l-4 border-blue-500 pl-4 mt-12">
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        <p class="text-xs text-slate-600 mb-4">
          Posted by {{ post.user.name }}
        </p>
        <p>
          {{ post.body }}
        </p>

        <div
          v-if="authStore.user && authStore.user.id === post.user_id"
          class="flex items-center gap-6 mt-6"
        >
          <form @submit.prevent="deletePost(post)">
            <button
              class="text-red-500 font-bold px-2 py-1 border border-red-300"
            >
              Delete
            </button>
          </form>

          <RouterLink
            :to="{ name: 'update', params: { id: post.id } }"
            class="text-green-500 font-bold px-2 py-1 border border-green-300"
            >Update</RouterLink
          >
        </div>
      </div>
    </div>
    <div v-else>
      <h2 class="title">Page not found!</h2>
    </div>
  </main>
</template> -->
<!-- <script setup>
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const { getPost, deletePost } = usePostsStore();
const authStore = useAuthStore();
const post = ref(null);
// onMounted(async () => {
//     console.log('Fetching post with ID:', route.params.id);
//     post.value = await getPost(route.params.id);
// });
onMounted(async () => {
  console.log('Fetching post with ID:', route.params.id);
  post.value = await getPost(route.params.id);
});


// onMounted(async () =>
//  (post.value = await getPost(route.params.id)));
</script>

<template>
  <main>
    <div v-if="post">
      <div class="border-l-4 border-blue-500 pl-4 mt-12">
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        <p class="text-xs text-slate-600 mb-4">
          Posted by {{ post.user.name }}
        </p>
        <p>{{ post.description }}</p>
        <p class="mt-2"><strong>Price:</strong> ${{ post.price }}</p>
        <p class="mt-2"><strong>Location:</strong> {{ post.location }}</p>
        <p class="mt-2"><strong>Area:</strong> {{ post.area }} sq ft</p>
        <p class="mt-2"><strong>Type:</strong> {{ post.type }}</p>
        <p class="mt-2"><strong>Status:</strong> {{ post.status }}</p>
        <p class="mt-2"><strong>Category:</strong> {{ post.category.name }}</p>
        <p v-if="post.image_url" class="mt-2">
          <img :src="post.image_url" alt="Post Image" class="mt-4 max-w-full h-auto">
        </p>

        <div
          v-if="authStore.user && authStore.user.id === post.user_id"
          class="flex items-center gap-6 mt-6"
        >
          <form @submit.prevent="deletePost(post)">
            <button
              class="text-red-500 font-bold px-2 py-1 border border-red-300"
            >
              Delete
            </button>
          </form>

          <RouterLink
            :to="{ name: 'update', params: { id: post.id } }"
            class="text-green-500 font-bold px-2 py-1 border border-green-300"
            >Update</RouterLink
          >
        </div>
      </div>
    </div>
    <div v-else>
      <h2 class="title">Page not found!</h2>
    </div>
  </main>
</template> -->
<script setup>



import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const postsStore = usePostsStore();
const authStore = useAuthStore();
const post = ref(null);


onMounted(async () => {
  post.value = await postsStore.getPost(route.params.id);
});
</script>

<!-- <template>
  <main>
    <div v-if="post">
      <div class="border-l-4 border-blue-500 pl-4 mt-12">
        
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        <p v-if="post.image_url" class="mt-2">
          <img :src="post.image_url" alt="Post Image" class="mt-4 max-w-full h-auto">
        </p>
        <p class="text-xs text-slate-600 mb-4">Posted by {{ post.user.name }}</p>
        <p>{{ post.description }}</p>
        <p class="mt-2"><strong>Price:</strong> ${{ post.price }}</p>
        <p class="mt-2"><strong>Location:</strong> {{ post.location }}</p>
        <p class="mt-2"><strong>Area:</strong> {{ post.area }}m²</p>
        <p class="mt-2"><strong>Type:</strong> {{ post.type }}</p>
        <p class="mt-2"><strong>Status:</strong> {{ post.status }}</p>
        



        <div
          v-if="authStore.user && authStore.user.id === post.user_id"
          class="flex items-center gap-6 mt-6"
        >
          <form @submit.prevent="deletePost(post)">
            <button class="text-red-500 font-bold px-2 py-1 border border-red-300">
              Delete
            </button>
          </form>

          <RouterLink
            :to="{ name: 'update', params: { id: post.id } }"
            class="text-green-500 font-bold px-2 py-1 border border-green-300"
          >
            Update
          </RouterLink>
        </div>
      </div>
    </div>
    <div v-else>
      <h2 class="title">Page not found!</h2>
    </div>
  </main>
</template> -->
<template>
  <main>
    <div v-if="post">
      <div class="border-l-4 border-blue-500 pl-4 mt-12">
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        <p v-if="post.image_url" class="mt-2">
          <img :src="post.image_url" alt="Post Image" class="mt-4 max-w-full h-auto">
        </p>
        <p class="text-xs text-slate-600 mb-4">Posted by {{ post.user.name }}</p>
        <p>{{ post.description }}</p>
        <p class="mt-2"><strong>Price:</strong> ${{ post.price }}</p>
        <p class="mt-2"><strong>Location:</strong> {{ post.location }}</p>
        <p class="mt-2"><strong>Area:</strong> {{ post.area }}m²</p>
        <p class="mt-2"><strong>Habitable Area:</strong> {{ post.habitable_area }}m²</p>
        <p class="mt-2"><strong>Type:</strong> {{ post.type }}</p>
        <p class="mt-2"><strong>Status:</strong> {{ post.status }}</p>
        <p class="mt-2"><strong>In City:</strong> {{ post.in_city ? 'Yes' : 'No' }}</p>
        <p class="mt-2"><strong>Fees Included:</strong> {{ post.fees_included ? 'Yes' : 'No' }}</p>
        <p class="mt-2"><strong>Reference Number:</strong> {{ post.reference_number }}</p>
        <!-- <p class="mt-2"><strong>Category:</strong> {{ post.category.name }}</p> -->

        <div
          v-if="authStore.user && authStore.user.id === post.user_id"
          class="flex items-center gap-6 mt-6"
        >
          <form @submit.prevent="deletePost(post)">
            <button class="text-red-500 font-bold px-2 py-1 border border-red-300">
              Delete
            </button>
          </form>

          <RouterLink
            :to="{ name: 'update', params: { id: post.id } }"
            class="text-green-500 font-bold px-2 py-1 border border-green-300"
          >
            Update
          </RouterLink>
        </div>
      </div>
    </div>
    <div v-else>
      <h2 class="title">Page not found!</h2>
    </div>
  </main>
</template>