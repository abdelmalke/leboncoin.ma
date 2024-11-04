<!-- 
<script setup>
import { usePostsStore } from "@/stores/posts";
import { storeToRefs } from "pinia";
import { reactive } from "vue";
import { useAuthStore } from "@/stores/auth";
import router from '@/router';



const authStore = useAuthStore();
const { errors } = storeToRefs(usePostsStore());
const { createPost } = usePostsStore();

const formData = reactive({
  title: "",
  description: "",
  price: null,
  location: "",
  area: null,
  type: "Residential",
  image_url: "",
  category_id: null,

  user_id: authStore.user ? authStore.user.id : null, // Include user_id


});
</script>



<template>
  <main>
    <h1 class="title">Create a new post</h1>

    <form
      @submit.prevent="createPost(formData)"
      class="w-1/2 mx-auto space-y-6"
    >
      <div>
        <input type="text" placeholder="Post Title" v-model="formData.title" />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>
      </div>

      <div>
        <textarea
          rows="6"
          placeholder="Post Description"
          v-model="formData.description"
        ></textarea>
        <p v-if="errors.description" class="error">{{ errors.description[0] }}</p>
      </div>

      <div>
        <input type="number" placeholder="Price" v-model="formData.price" />
        <p v-if="errors.price" class="error">{{ errors.price[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Location"
          v-model="formData.location"
        />
        <p v-if="errors.location" class="error">{{ errors.location[0] }}</p>
      </div>

      <div>
        <input type="number" placeholder="Area (sq ft)" v-model="formData.area" />
        <p v-if="errors.area" class="error">{{ errors.area[0] }}</p>
      </div>

      <div>
        <select v-model="formData.type">
          <option value="Residential">Residential</option>
          <option value="Agricultural">Agricultural</option>
        </select>
        <p v-if="errors.type" class="error">{{ errors.type[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Image URL"
          v-model="formData.image_url"
        />
        <p v-if="errors.image_url" class="error">{{ errors.image_url[0] }}</p>
      </div>

      <div>
        <input
          type="number"
          placeholder="Category ID"
          v-model="formData.category_id"
        />
        <p v-if="errors.category_id" class="error">{{ errors.category_id[0] }}</p>
      </div>

      <button class="primary-btn">Create</button>
    </form>
  </main>
</template> -->
<script setup>
import { usePostsStore } from "@/stores/posts";
import { storeToRefs } from "pinia";
import { reactive } from "vue";
import { useAuthStore } from "@/stores/auth";


const authStore = useAuthStore();
const { errors } = storeToRefs(usePostsStore());
const { createPost } = usePostsStore();

const formData = reactive({
  title: "",
  description: "",
  price: null,
  location: "",
  area: null,
  type: "Residential",
  image_url: "",
  category_id: null,
  user_id: authStore.user ? authStore.user.id : null, // Include user_id
  type_of_property: "",
  habitable_area: null,       // Added habitable_area
  in_city: false,             // Added in_city
  fees_included: false,       // Added fees_included
  reference_number: ""        // Added reference_number
});
</script>

<template>
  <main>
    <h1 class="title">Create a New Post</h1>

    <form
      @submit.prevent="createPost(formData)"
      class="w-1/2 mx-auto space-y-6"
    >
      <div>
        <input
          type="text"
          placeholder="Post Title"
          v-model="formData.title"
        />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>
      </div>

      <div>
        <textarea
          rows="6"
          placeholder="Post Description"
          v-model="formData.description"
        ></textarea>
        <p v-if="errors.description" class="error">{{ errors.description[0] }}</p>
      </div>

      <div>
        <input
          type="number"
          placeholder="Price"
          v-model="formData.price"
        />
        <p v-if="errors.price" class="error">{{ errors.price[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Location"
          v-model="formData.location"
        />
        <p v-if="errors.location" class="error">{{ errors.location[0] }}</p>
      </div>

      <div>
        <input
          type="number"
          placeholder="Area"
          v-model="formData.area"
        />
        <p v-if="errors.area" class="error">{{ errors.area[0] }}</p>
      </div>
      <div>
        <input
          type="number"
          placeholder="Habitable Area "
          v-model="formData.habitable_area"
        />
        <p v-if="errors.habitable_area" class="error">{{ errors.habitable_area[0] }}</p>
      </div>

      <div>
        <select v-model="formData.type">
          <option value="Residential">Residential</option>
          <option value="Agricultural">Agricultural</option>
        </select>
        <p v-if="errors.type" class="error">{{ errors.type[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Image URL (optional)"
          v-model="formData.image_url"
        />
        <p v-if="errors.image_url" class="error">{{ errors.image_url[0] }}</p>
      </div>

      <div>
        <input
          type="number"
          placeholder="Category ID (optional)"
          v-model="formData.category_id"
        />
        <p v-if="errors.category_id" class="error">{{ errors.category_id[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Type of Property (optional)"
          v-model="formData.type_of_property"
        />
        <p v-if="errors.type_of_property" class="error">{{ errors.type_of_property[0] }}</p>
      </div>



      <div>
        <label>
          <input
            type="checkbox"
            v-model="formData.in_city"
          />
          In City
        </label>
        <p v-if="errors.in_city" class="error">{{ errors.in_city[0] }}</p>
      </div>

      <div>
        <label>
          <input
            type="checkbox"
            v-model="formData.fees_included"
          />
          Fees Included
        </label>
        <p v-if="errors.fees_included" class="error">{{ errors.fees_included[0] }}</p>
      </div>

      <div>
        <input
          type="text"
          placeholder="Reference Number (optional)"
          v-model="formData.reference_number"
        />
        <p v-if="errors.reference_number" class="error">{{ errors.reference_number[0] }}</p>
      </div>

      <button class="primary-btn">Create</button>
    </form>
  </main>
</template>
