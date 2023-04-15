import { createRouter, createWebHashHistory } from 'vue-router'
import axios from 'axios'

axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
  }, function (error) {
    if( error.response && error.response.status == '401' ){
        console.log('USUARIO NO AUTENTICADO')
        window.location.href = '/#/login'
        return Promise.reject(error);
    }
    if( error.response && error.response.status == '403' ){
        window.location.href = '/#/'
    }
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
  });

const routes = [
    {
        path:'/login',
        component: () => import('./pages/Login.vue')
    },
    {
        path:'/',
        component: () => import('./pages/Solicitudes.vue'),
        beforeEnter: async (to, from) => {
            try {
                await axios.get(`solicitudes`)
            }
            catch(error){
                if(error.response.status == 401){
                    return '/login'
                }
            }
        },
    },
    {
        path:'/crear-solicitud',
        component: () => import('./pages/CrearSolicitud.vue')
    },
    {
        path:'/solicitudes',
        component: () => import('./pages/Solicitudes.vue'),
        beforeEnter: async (to, from) => {
            try {
                await axios.get(`solicitud/${to.params.solicitude}`)
            }
            catch(error){
                if(error.response.status == 401){
                    return '/login'
                }
            }
        },
    },
    {
        path:'/solicitudes/:solicitude',
        component: () => import('./pages/Solicitud.vue'),
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;
