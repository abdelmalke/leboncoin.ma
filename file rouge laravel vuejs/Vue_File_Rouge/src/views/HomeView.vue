<!-- <script setup>
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";

const { getAllPosts } = usePostsStore();
const posts = ref([]);

onMounted(async () => (posts.value = await getAllPosts()));
</script>

<template>
  <main>
    <h1 class="title">Latest Posts</h1>

    <div v-if="posts.length > 0">
  <div
    v-for="post in posts"
    :key="post.id"
    class="border-l-4 border-blue-500 pl-4 mb-12"
  >
    <h2 class="font-bold text-3xl">{{ post.title }}</h2>
 
    <p class="text-xs text-slate-600 mb-4">
      Posted by {{ post.user?.name || 'Unknown' }}
    </p>
    <p>
      {{ post.body }}
      <RouterLink
        :to="{ name: 'show', params: { id: post.id } }"
        class="text-blue-500 font-bold underline"
        >Read more...</RouterLink
      >
    </p>
  </div>
</div>

    <div v-else>
      <h2 class="title">There are no posts</h2>
    </div>
  </main>
</template> -->
<!-- <script setup>
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";

const { getAllPosts } = usePostsStore();
const posts = ref([]);

onMounted(async () => {
  posts.value = await getAllPosts();
});
</script>

<template>
  <main>
    <h1 class="title">Latest Posts</h1>

    <div v-if="posts.length > 0">
      <div
        v-for="post in posts"
        :key="post.id"
        class="border-l-4 border-blue-500 pl-4 mb-12"
      >
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        
        <img
          v-if="post.image_url"
          :src="post.image_url"
          :alt="post.title"
          class="w-full h-auto mt-2 mb-4"
        />

        <p class="text-xs text-slate-600 mb-4">
          Posted by {{ post.user?.name || "Unknown" }}
        </p>

        <p class="text-lg font-semibold text-green-600 mb-2">
          Price: ${{ post.price.toLocaleString() }}
        </p>

        <p class="text-sm text-gray-700 mb-2">
          Location: {{ post.location }}
        </p>

        <p class="text-sm mb-4" :class="{
          'text-green-600': post.status === 'active',
          'text-yellow-500': post.status === 'inactive',
          'text-red-600': post.status === 'sold'
        }">
          Status: {{ post.status }}
        </p>

        <p>
          {{ post.body }}
          <RouterLink
            :to="{ name: 'show', params: { id: post.id } }"
            class="text-blue-500 font-bold underline"
            >Read more...</RouterLink
          >
        </p>
      </div>
    </div>

    <div v-else>
      <h2 class="title">There are no posts</h2>
    </div>
  </main>
</template> -->
<!-- <script setup>
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";

const { getAllPosts } = usePostsStore();
const posts = ref([]);

onMounted(async () => {
  posts.value = await getAllPosts();
});
</script>

<template>
  <main>
    <h1 class="title">Latest Posts</h1>

    <div v-if="posts.length > 0">
      <div
        v-for="post in posts"
        :key="post.id"
        class="border-l-4 border-blue-500 pl-4 mb-12"
      >
        <h2 class="font-bold text-3xl">{{ post.title }}</h2>
        
        <img
          v-if="post.image_url"
          :src="post.image_url"
          :alt="post.title"
          class="w-full h-auto mt-2 mb-4"
        />

        <p class="text-xs text-slate-600 mb-4">
          Posted by {{ post.user?.name || "Unknown" }}
        </p>

        <p class="text-lg font-semibold text-green-600 mb-2">
          Price: ${{ post.price.toLocaleString() }}
        </p>

        <p class="text-sm text-gray-700 mb-2">
          Location: {{ post.location }}
        </p>

        <p class="text-sm mb-4" :class="{
          'text-green-600': post.status === 'active',
          'text-yellow-500': post.status === 'inactive',
          'text-red-600': post.status === 'sold'
        }">
          Status: {{ post.status }}
        </p>

        <p>
          {{ post.body }}
          <RouterLink
            :to="{ name: 'show', params: { id: post.id } }"
            class="text-blue-500 font-bold underline"
            >Read more...</RouterLink
          >
        </p>
      </div>
    </div>

    <div v-else>
      <h2 class="title">There are no posts</h2>
    </div>
  </main>
</template> -->
<script setup>
import { usePostsStore } from "@/stores/posts";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";

const { getAllPosts } = usePostsStore();
const posts = ref([]);

onMounted(async () => {
  posts.value = await getAllPosts();
});
</script>

<template>
  <main>
    <h1 class="title">Latest Posts</h1>

    <div class="grid grid-cols-3 gap-4">
      <div
        v-for="post in posts"
        :key="post.id"
        class="border rounded-lg shadow-md p-4 bg-white"
      >
        <!-- Post Image -->
        <img
          v-if="post.image_url"
          :src="post.image_url"
          :alt="post.title"
          class="w-full h-48 object-cover rounded-t-lg mb-4"
        />

        <!-- Post Title -->
        <h2 class="font-bold text-2xl mb-2">{{ post.title }}</h2>

        <!-- Post Price -->
        <p class="text-lg text-green-600 font-semibold mb-2">
          Price: ${{ post.price.toLocaleString() }}
        </p>

        <!-- Post Location -->
        <p class="text-sm text-gray-700 mb-2">Location: {{ post.location }}</p>

        <!-- Post Status -->
        <p class="text-sm mb-4" :class="{
          'text-green-600': post.status === 'active',
          'text-yellow-500': post.status === 'inactive',
          'text-red-600': post.status === 'sold'
        }">
          Status: {{ post.status }}
        </p>

        <!-- Read More Button -->
        <RouterLink
          :to="{ name: 'show', params: { id: post.id } }"
          class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600"
        >
          Read More
        </RouterLink>
      </div>
    </div>
    <!-- No Posts Fallback -->
<!-- <div v-else>
  <h2 class="title">No posts found. Please check back later!</h2>
</div> -->
  </main>
</template>