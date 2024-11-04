// // import { defineStore } from "pinia";
// // import Cookies from 'js-cookie';


// // export const useAuthStore = defineStore("authStore", {
// //   state: () => {
// //     return {
// //       user: null,
// //       errors: {},
// //     };
// //   },
// //   actions: {
// //     /******************* Get authenticated user *******************/
// //     // async getUser() {
// //     //   if (localStorage.getItem("token")) {
// //     //     const res = await fetch("/api/user", {
// //     //       headers: {
// //     //         authorization: `Bearer ${localStorage.getItem("token")}`,
// //     //       },
// //     //     });
// //     //     const data = await res.json();
// //     //     if (res.ok) {
// //     //       this.user = data;
// //     //     }
// //     //   }
// //     // },
// //     async getUser() {
// //       const token = Cookies.get('token');
// //       if (token) {
// //         const res = await fetch("/api/user", {
// //           headers: {
// //             Authorization: `Bearer ${token}`,
// //           },
// //         });
// //         const data = await res.json();
// //         if (res.ok) {
// //           this.user = data;
// //         }
// //       }
// //     },
    
// //     /******************* Login or Register user *******************/
// //     // async authenticate(apiRoute, formData) {
// //     //   const res = await fetch(`/api/${apiRoute}`, {
// //     //     method: "post",
// //     //     body: JSON.stringify(formData),
// //     //   });

// //     //   const data = await res.json();
// //     //   if (data.errors) {
// //     //     this.errors = data.errors;
// //     //   } else {
// //     //     this.errors = {};
// //     //     localStorage.setItem("token", data.token);
// //     //     this.user = data.user;
// //     //     this.router.push({ name: "home" });
// //     //   }
// //     // },
// //     async authenticate(apiRoute, formData) {
// //       const res = await fetch(`/api/${apiRoute}`, {
// //         method: "post",
// //         headers: {
// //           "Content-Type": "application/json",
// //         },
// //         body: JSON.stringify(formData),
// //       });
    
// //       const data = await res.json();
// //       if (data.errors) {
// //         this.errors = data.errors;
// //       } else {
// //         this.errors = {};
// //         // Store token in cookies instead of localStorage
// //         Cookies.set('token', data.token, { expires: 7, secure: true, sameSite: 'Strict' });
// //         this.user = data.user;
// //         this.router.push({ name: "home" });
// //       }
// //     },
    
// //     /******************* Logout user *******************/
// //     // async logout() {
// //     //   const res = await fetch("/api/logout", {
// //     //     method: "post",
// //     //     headers: {
// //     //       authorization: `Bearer ${localStorage.getItem("token")}`,
// //     //     },
// //     //   });

// //     //   const data = await res.json();
// //     //   console.log(data);

// //     //   if (res.ok) {
// //     //     this.user = null;
// //     //     this.errors = {};
// //     //     localStorage.removeItem("token");
// //     //     this.router.push({ name: "home" });
// //     //   }
// //     // },
// //     async logout() {
// //       const token = Cookies.get('token');
// //       const res = await fetch("/api/logout", {
// //         method: "post",
// //         headers: {
// //           Authorization: `Bearer ${token}`,
// //         },
// //       });
    
// //       const data = await res.json();
// //       console.log(data);
    
// //       if (res.ok) {
// //         this.user = null;
// //         this.errors = {};
// //         Cookies.remove('token'); // Remove the token from cookies
// //         this.router.push({ name: "home" });
// //       }
// //     },    
// //   },
// // });
// // import { defineStore } from "pinia";
// // import router from "@/router";
// // import Cookies from 'js-cookie';

// // export const useAuthStore = defineStore("authStore", {
// // state: () =>{
// // return {
// // user: '',
// // errors:{},
// // };
// // },
// // actions:{
// //     /******************* Get authenticated user *******************/
// //     async getUser() {
// //         if (localStorage.getItem("token")) {
// //           const res = await fetch("/api/user", {
// //             headers: {
// //               authorization: `Bearer ${localStorage.getItem("token")}`,
// //             },
// //           });
// //           const data = await res.json();
// //           if (res.ok) {
// //             this.user = data;
// //           }
          
// //         }
// //       },
// //       /******************* Login or Register user *******************/
// //       async authenticate(apiRoute, formData) {
// //         const res = await fetch(`/api/${apiRoute}`, {
// //           method: "post",
// //           body: JSON.stringify(formData),
// //         });
  
// //         const data = await res.json();
// //         if (data.errors) {
// //           this.errors = data.errors;
// //         } else {
// //           this.errors = {};
// //           localStorage.setItem("token", data.token);
// //           this.user = data.user;
// //           router.push({ name: "home" });
// //         }
// //       },
// //        /******************* Logout user *******************/
// //     async logout() {
// //       const res = await fetch("/api/logout", {
// //         method: "post",
// //         headers: {
// //           authorization: `Bearer ${localStorage.getItem("token")}`,
// //         },
// //       });

// //       const data = await res.json();
// //       console.log(data);

// //       if (res.ok) {
// //         this.user = null;
// //         this.errors = {};
// //         localStorage.removeItem("token");
// //         router.push({ name: "home" });
// //       }
// //     },
// //   },
// // });


// import { defineStore } from "pinia";
// import router from "@/router";
// import Cookies from 'js-cookie';

// export const useAuthStore = defineStore("authStore", {

//   state: () => ({
//     user: '',
//     role : null,
//     errors: {},
//   }),

//   actions: {
//     /******************* Get authenticated user *******************/
//     async getUser() {
//       console.log('role from state : ',this.$state.role);

//       const token = Cookies.get("token");
//       const role = Cookies.get("role");
//       console.log('role namee :', role); 
//       if (token) {
//         const res = await fetch("/api/user", {
//           headers: {
//             Authorization: `Bearer ${token}`,
//           },
//         });
//         const data = await res.json();
        
//         console.log('API response:', data); // Log the entire response
        
//         if (res.ok) {
//           this.user = data;
//           console.log('User data set:', this.user); // Confirm that the user data is set
//           console.log('role namee :', this.role); // Confirm that the user data is set
//         } 
//         else {
//           console.error('Failed to fetch user:', data.errors);
//         }
//       } else {
//         console.error('No token found in cookies.');
//       }
//     },
    

//     // async getUser() {
//     //   const token = Cookies.get("token");
//     //   if (token) {
//     //     const res = await fetch("/api/user", {
//     //       headers: {
//     //         Authorization: `Bearer ${token}`,

//     //       },
//     //     });
//     //     const data = await res.json();
//     //     if (res.ok) {
//     //       this.user = data;
//     //     } else {
//     //       console.error('Failed to fetch user:', data.errors);
//     //     }
//     //   } else {
//     //     console.error('No token found in cookies.');
//     //   }
//     // },
//     /****************** Login or Register user *******************/
//     async authenticate(apiRoute, formData) {
//       const res = await fetch(`/api/${apiRoute}`, {
//         method: "post",
//         body: JSON.stringify(formData),
//         headers: {

//           'Content-Type': 'application/json',
//         },
//       });

//       const data = await res.json();
//       if (data.errors) {
//         this.errors = data.errors;
//       } else {
//         this.errors = {};
//         Cookies.set("token", data.token); // Use Cookies for token
//         Cookies.set("role", data.role); // Use Cookies for role
//         this.user = data.user;
//         this.role = data.role;
//         console.log('role from state : ',this.$state.role);
        
//         router.push({ name: "home" });
//       }
//     },

//     /******************* create User *******************/
//     async createUser(formData) {
//       const token = Cookies.get("token");

//       const res = await fetch("/api/admin/users", {
//         method: "post",
//         headers: {
//           Authorization: `Bearer ${token}`,
//           'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(formData),
//       });

//       const data = await res.json();

//       if (res.ok) {
//         this.errors = {};
//         router.push({ name: "home" }); 
//       } else {
//         this.errors = data.errors;
//       }
//     },
 
//     /******************* Logout user *******************/
//     async logout() {
//       const token = Cookies.get("token");
//       if (token) {
//         const res = await fetch("/api/logout", {
//           method: "post",
//           headers: {
//             Authorization: `Bearer ${token}`,
//           },
//         });

//         const data = await res.json();
//         if (res.ok) {
//           this.user = null;
//           this.role = null;
//           this.errors = {};
//           Cookies.remove("token"); // Remove token from Cookies
//           Cookies.remove("role"); // Remove role from Cookies
//           router.push({ name: "home" });
//         } else {
//           console.error('Failed to logout:', data.errors);
//         }
//       } else {
//         console.error('No token found in cookies.');
//       }
//     },
//   },
// });
// // import { defineStore } from "pinia";
// // import router from "@/router";
// // import Cookies from 'js-cookie';

// // export const useAuthStore = defineStore("authStore", {
// //   state: () => ({
// //     user: '',
// //     role: null,
// //     errors: {},
// //   }),

// //   actions: {
// //     /******************* Get authenticated user *******************/
// //     async getUser() {
// //       const token = Cookies.get("token");
// //       if (token) {
// //         const res = await fetch("/api/user", {
// //           headers: {
// //             Authorization: `Bearer ${token}`,
// //           },
// //         });
// //         const data = await res.json();
        
// //         if (res.ok) {
// //           this.user = data.user;
// //           this.role = data.role;
// //           console.log('User data set:', this.user); 
// //           console.log('Role name:', this.role); 
// //         } else {
// //           console.error('Failed to fetch user:', data.errors);
// //         }
// //       } else {
// //         console.error('No token found in cookies.');
// //       }
// //     },

// //     /****************** Login or Register user *******************/
// //     async authenticate(apiRoute, formData) {
// //       const res = await fetch(`/api/${apiRoute}`, {
// //         method: "post",
// //         body: JSON.stringify(formData),
// //         headers: {
// //           'Content-Type': 'application/json',
// //         },
// //       });

// //       const data = await res.json();
// //       if (data.errors) {
// //         this.errors = data.errors;
// //       } else {
// //         this.errors = {};
// //         Cookies.set("token", data.token); // Store token in cookies
// //         Cookies.set("role", data.role); // Store role in cookies
// //         this.user = data.user;
// //         this.role = data.role;
// //         router.push({ name: "home" });
// //       }
// //     },

// //     /******************* create User *******************/
// //     async createUser(formData) {
// //       const token = Cookies.get("token");

// //       const res = await fetch("/api/admin/users", {
// //         method: "post",
// //         headers: {
// //           Authorization: `Bearer ${token}`,
// //           'Content-Type': 'application/json',
// //         },
// //         body: JSON.stringify(formData),
// //       });

// //       const data = await res.json();

// //       if (res.ok) {
// //         this.errors = {};
// //         router.push({ name: "home" });
// //       } else {
// //         this.errors = data.errors;
// //       }
// //     },
 
// //     /******************* Logout user *******************/
// //     async logout() {
// //       const token = Cookies.get("token");
// //       if (token) {
// //         const res = await fetch("/api/logout", {
// //           method: "post",
// //           headers: {
// //             Authorization: `Bearer ${token}`,
// //           },
// //         });

// //         const data = await res.json();
// //         if (res.ok) {
// //           this.user = null;
// //           this.role = null;
// //           this.errors = {};
// //           Cookies.remove("token"); // Remove token from Cookies
// //           Cookies.remove("role"); // Remove role from Cookies
// //           router.push({ name: "home" });
// //         } else {
// //           console.error('Failed to logout:', data.errors);
// //         }
// //       } else {
// //         console.error('No token found in cookies.');
// //       }
// //     },
// //   },
// // });
import { defineStore } from "pinia";
import router from "@/router";
import Cookies from 'js-cookie';

export const useAuthStore = defineStore("authStore", {
  state: () => ({
    user: '',
    role: null,
    errors: {},
  }),

  actions: {
    /******************* Get authenticated user *******************/
    async getUser() {
      try {
        const token = Cookies.get("token");
        if (token) {
          const res = await fetch("/api/user", {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          const data = await res.json();
          if (res.ok) {
            this.user = data;
            this.role = Cookies.get("role");
            console.log('User data set:', this.role);
          } else {
            this.errors = data.errors;
            console.error('Failed to fetch user:', data.errors);
          }
        } else {
          console.error('No token found in cookies.');
        }
      } catch (error) {
        console.error('Error during fetching user:', error);
      }
    },

    /****************** Login or Register user *******************/
    async authenticate(apiRoute, formData) {
      try {
        const res = await fetch(`/api/${apiRoute}`, {
          method: "post",
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.errors = {};
          Cookies.set("token", data.token, { expires: 7, secure: true, sameSite: 'Strict' });
          Cookies.set("role", data.role, { expires: 7, secure: true, sameSite: 'Strict' });
          this.user = data.user;
          this.role = data.role;
          router.push({ name: "home" });
        }
      } catch (error) {
        console.error('Error during authentication:', error);
      }
    },

    /******************* Create User *******************/
    async createUser(formData) {
      try {
        const token = Cookies.get("token");
        const res = await fetch("/api/users", {
          method: "post",
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (res.ok) {
          this.errors = {};
          router.push({ name: "home" });
        } else {
          this.errors = data.errors;
          console.error('Failed to create user:', data.errors);
        }
      } catch (error) {
        console.error('Error during user creation:', error);
      }
    },

    /******************* Logout user *******************/
    async logout() {
      try {
        const token = Cookies.get("token");
        if (token) {
          const res = await fetch("/api/logout", {
            method: "post",
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

          const data = await res.json();
          if (res.ok) {
            this.user = null;
            this.role = null;
            this.errors = {};
            Cookies.remove("token");
            Cookies.remove("role");
            router.push({ name: "home" });
          } else {
            console.error('Failed to logout:', data.errors);
          }
        } else {
          console.error('No token found in cookies.');
        }
      } catch (error) {
        console.error('Error during logout:', error);
      }
    },
  },
});
