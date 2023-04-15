<template>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Detalles de la solicitud
                </div>
                <div class="card-body" v-if="solicitude">
                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Fecha de solicitud
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ new Date(solicitude.created_at) }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Primer nombre
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.primer_nombre }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Segundo nombre
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.segundo_nombre }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Primer apellido
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.primer_apellido }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Segundo apellido
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.segundo_apellido }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Sexo
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.sexo }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Estado civil
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.estado_civil }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Tipo de documento
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.tipo_documento }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            CUI
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.cui }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Dirección
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.direccion }}
                        </div>
                    </div>

                    <div class="row py-1">
                        <div class="col-lg-4 text-left">
                            Teléfono
                        </div>
                        <div class="col-lg-8 text-end">
                            {{ solicitude.telefono }}
                        </div>
                    </div>
                </div>
                <div class="card-footer" v-if="solicitude">
                    <div v-if="(solicitude.status == 'pendiente') && auth.user && auth.user.role == 'tecnico'" class="d-flex">
                        <button class="btn btn-danger w-100 mr-3" @click="updateSolicitude('denegada')">Denegar</button>
                        <button class="btn btn-primary w-100" @click="updateSolicitude('aprobada')">Aprobar</button>
                    </div>
                    <div v-else>
                        <div class="card card-body text-white bg-primary w-100 text-center">
                            Solicitud {{ solicitude.status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ms-auto" v-if="solicitude">
            <div class="card">
                <div class="card-body">
                    <a :href="solicitude.dpi" target="_blank" class="d-flex align-items-center">
                        <img src="/assets/pdf.svg" alt="" class="me-2" style="width: 30px;">
                        <span class="ms-auto me-3">
                            DPI - Descargar archivo adjunto
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router';
import { useAuthStore } from '../stores/auth';
import { toast } from 'vue3-toastify';

const auth = useAuthStore()
const solicitude = ref(null)
const route = useRoute()

function updateSolicitude(status){
    if( window.confirm('Desea actualizar el estado de la solicitud?') )
    axios.post(`solicitudes/${solicitude.value.id}`, {status, '_method':'PUT'})
    .then(response => {
        solicitude.value = response.data.data
        toast.success('Solicitud actualizada con éxito');
    })
    .catch(error => console.log(error.response))
}

onMounted(() => {
    axios.get(`solicitudes/${route.params.solicitude}`)
    .then(response => solicitude.value = response.data.data)
    .catch(error => console.log(error.response))
})
</script>
