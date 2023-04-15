<template>
    <div id="solicitudes">

        <router-link
            v-if="auth.user && auth.user.role == 'normal'"
            to="crear-solicitud"
            class="btn btn-primary fab"
            title="Registrar solicitud">
            +
        </router-link>

        <div class="card">
            <div class="card-body">
                <div class="table">
                    <table class="table table-sm">
                        <thead>
                            <th>Sexo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de nacimiento</th>
                            <th>Email</th>
                            <th>CUI</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <tr v-for="solicitude in solicitudes">
                                <td>
                                    {{ solicitude.sexo }}
                                </td>
                                <td>
                                    {{ solicitude.primer_nombre }}
                                </td>
                                <td>
                                    {{ solicitude.primer_apellido }}
                                </td>
                                <td>
                                    {{ solicitude.fecha_nacimiento }}
                                </td>
                                <td>
                                    {{ solicitude.email }}
                                </td>
                                <td>
                                    {{ solicitude.cui }}
                                </td>
                                <td>
                                    <span class="badge bg-primary"
                                    :class="{'bg-success':solicitude.status == 'aprobada', 'bg-danger':solicitude.status == 'denegada', 'bg-success':solicitude.secondary == 'pendiente'}">
                                        {{ solicitude.status }}
                                    </span>
                                </td>
                                <td>
                                    <router-link :to="`/solicitudes/${solicitude.id}`">Ver</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../stores/auth';
const solicitudes = ref([])
const auth = useAuthStore()

onMounted(() => {
    axios.get('solicitudes')
        .then(response => {
            solicitudes.value = response.data.data
        })
        .catch(error => { console.log(error.response) })
        .finally()
})
</script>
