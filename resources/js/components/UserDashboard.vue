<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card">
                    <div class="card-header">Clients</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in clients"
                                    :key="client.id" 
                                    @click="openClientForm(client.id)"
                                    class="client-link">
                                    <td>#{{client.id}}</td>
                                    <td>{{clientName(client)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary" @click.prevent="createNewClient">New Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'user-dashboard',
    data() {
        return {
            clients: []
        }
    },
    mounted() {
        let _self = this;
        axios.get('/clients').then(response=>{
            console.log(response);
            _self.clients = response.data;
        }).catch(error=>{
            console.log(error);
        })
    },
    methods: {
        createNewClient() {
            let _self = this;
            axios.post('/clients').then(response=>{
                _self.clients.push(response.data);
            }).catch(error=>{
                console.log(error);
            });
        },
        clientName(client) {
            if(client.firstName) {
                return `${client.firstName} ${client.lastName}`;
            } else {
                return 'Not Given';
            }
        },
        openClientForm(id) {
            window.location = `${window.location.origin}/clients/${id}`;
        }
    }

}
</script>

<style lang="scss">
.client-link {
    cursor: pointer;
}
</style>