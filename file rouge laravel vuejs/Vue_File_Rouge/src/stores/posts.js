// import { defineStore } from "pinia";
// import { useAuthStore } from "./auth";

// export const usePostsStore = defineStore("postsStore", {
//   state: () => {
//     return {
//       errors: {},
//     };
//   },
//   actions: {
//     /******************* Get all posts *******************/
//     // async getAllPosts() {
//     //   const res = await fetch("/api/posts");
//     //   const data = await res.json();

//     //   return data;
//     // },
//     async getAllPosts() {
//       const res = await fetch("/api/posts", {
//           headers: {
//               Authorization: `Bearer ${localStorage.getItem("token")}`,
//           },
//       });
//       const data = await res.json();
//       return data;
//   },
//     /******************* Get a post *******************/
//     // async getPost(post) {
//     //   const res = await fetch(`/api/posts/${post}`);
//     //   const data = await res.json();

//     //   return data.post;
//     // },
//     async getPost(postId) {
//       const token = localStorage.getItem("token");
//       // if (!token) {
//       //   console.error("No token found in local storage.");
//       //   return;
//       // }
    
//       const res = await fetch(`/api/posts/${postId}`, {
//         headers: {
//           'Authorization': `Bearer ${token}`
//         },
//       });
    
//       // if (!res.ok) {
//       //   console.error(`HTTP error ${res.status}: ${await res.text()}`);
//       //   return;
//       // }
    
//       const data = await res.json();
//       return data.post;
//     },
//     /******************* Create a post *******************/
//     // async createPost(formData) {
//     //   const res = await fetch("/api/posts", {
//     //     method: "post",
//     //     headers: {
//     //       Authorization: `Bearer ${localStorage.getItem("token")}`,
//     //     },
//     //     body: JSON.stringify(formData),
//     //   });

//     //   const data = await res.json();

//     //   if (data.errors) {
//     //     this.errors = data.errors;
//     //   } else {
//     //     this.router.push({ name: "home" });
//     //     this.errors = {}
//     //   }
//     // },
//     async createPost(formData) {
//       const res = await fetch("/api/posts", {
//           method: "post",
//           headers: {
//               Authorization: `Bearer ${localStorage.getItem("token")}`,
//               'Content-Type': 'application/json' // Added content type for JSON body
//           },
//           body: JSON.stringify(formData),
//       });
  
//       if (res.status === 401) {
//           localStorage.removeItem("token");
//           this.router.push({ name: "login" });
//           return;
//       }
  
//       const data = await res.json();
  
//       if (data.errors) {
//           this.errors = data.errors;
//       } else {
//           this.router.push({ name: "home" });
//           this.errors = {}
//       }
//   }
// ,  
//     /******************* Delete a post *******************/
//     async deletePost(post) {
//       const authStore = useAuthStore();
//       if (authStore.user.id === post.user_id) {
//         const res = await fetch(`/api/posts/${post.id}`, {
//           method: "delete",
//           headers: {
//             Authorization: `Bearer ${localStorage.getItem("token")}`,
//           },
//         });

//         const data = await res.json();
//         if (res.ok) {
//           this.router.push({ name: "home" });
//         }
//         console.log(data);
//       }
//     },
//     /******************* Update a post *******************/
//     async updatePost(post, formData) {
//       const authStore = useAuthStore();
//       if (authStore.user.id === post.user_id) {
//         const res = await fetch(`/api/posts/${post.id}`, {
//           method: "put",
//           headers: {
//             Authorization: `Bearer ${localStorage.getItem("token")}`,
//           },
//           body: JSON.stringify(formData),
//         });

//         const data = await res.json();
//         if (data.errors) {
//           this.errors = data.errors;
//         } else {
//           this.router.push({ name: "home" });
//           this.errors = {}
//         }
//       }
//     },
//   },
// });
import Cookies from 'js-cookie';
import { defineStore } from "pinia";
import router from '@/router'; 
import { useAuthStore } from "./auth";


export const usePostsStore = defineStore("postsStore", {
  state: () => {
    return {
      errors: {},
    };
  },
  actions: {
    /******************* Get all posts *******************/
    // async getAllPosts() {
    //   const token = Cookies.get('token');
    //   const res = await fetch("/api/posts", {
    //     headers: {
    //       Authorization: `Bearer ${token}`,
    //     },
    //   });
    //   const data = await res.json();
    //   return data;
    // },
    async getAllPosts() {
      const token = Cookies.get('token');
      const res = await fetch("/api/posts", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      const data = await res.json();
      // console.log(data); // Log the entire response to check structure
      return data;
    },
    

    /******************* Get a post *******************/
    // async getPost(postId) {
    //   const token = Cookies.get('token');
    //   if (!token) {
    //     console.error("No token found in cookies.");
    //     return;
    //   }
    
    //   const res = await fetch(`/api/posts/${postId}`, {
    //     headers: {
    //       'Authorization': `Bearer ${token}`,
    //     },
    //   });
    
    //   if (!res.ok) {
    //     console.error(`HTTP error ${res.status}: ${await res.text()}`);
    //     return;
    //   }
    
    //   const data = await res.json();
    //   return data.post;
    // },
    async getPost(postId) {
      const token = Cookies.get('token');
      if (!token) {
        console.error("No token found in cookies.");
        return;
      }
      const res = await fetch(`/api/posts/${postId}`, {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
      });
      if (!res.ok) {
        console.error(`HTTP error ${res.status}: ${await res.text()}`);
        return;
      }
      const data = await res.json();
      console.log('Fetched post data:', data);
      return data.post;
    },
    /******************* Create a post *******************/
    async createPost(formData) {
      const token = Cookies.get('token');
      const res = await fetch("/api/posts", {
        method: "post",
        headers: {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });
  
      if (res.status === 401) {
        Cookies.remove("token");
        router.push({ name: "login" });
        return;
      }
  
      const data = await res.json();
  
      if (data.errors) {
        this.errors = data.errors;
      } else {
        router.push({ name: "home" });
        this.errors = {};
      }
    },

    
    /******************* Delete a post *******************/
    async deletePost(post) {
      const authStore = useAuthStore();
      const token = Cookies.get('token');
      if (authStore.user.id === post.user_id) {
        const res = await fetch(`/api/posts/${post.id}`, {
          method: "delete",
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        const data = await res.json();
        if (res.ok) {
          this.router.push({ name: "home" });
        }
        console.log(data);
      }
    },

    /******************* Update a post *******************/
    async updatePost(post, formData) {
      const authStore = useAuthStore();
      const token = Cookies.get('token');
      if (authStore.user.id === post.user_id) {
        const res = await fetch(`/api/posts/${post.id}`, {
          method: "put",
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.router.push({ name: "home" });
          this.errors = {};
        }
      }
    },
  },
});
