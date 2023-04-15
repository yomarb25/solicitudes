import { defineStore } from 'pinia'

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAuthStore = defineStore('auth', {
    state: ()=>({
        user: null,
        errors: {}
    }),
    actions: {
        async login(email, password){
            try {
                await axios.post('login', {email, password})
                await this.fetchUser()
                this.router.push('/solicitudes')
            }
            catch(error){
                if( error.response && error.response.data.errors ){
                    this.errors = {...error.response.data.errors}
                }
            }
        },
        async fetchUser(){
            axios.get('user')
            .then(response  => this.user = response.data)
            .catch(error => console.log(error.response))
        },
        logout(){
            axios.post('logout')
            .then(response => {
                this.user = null
                this.router.push('/login')
            })
            .catch(error => console.log(error.response))
        }
    }
})
