<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Users awaiting access</div>

                    <div class="card-body">

                        <div class="d-flex flex-wrap justify-content-center">
                            <div class="card mx-2 mb-3 shadow" v-for="(user, index) in usersCopy" :key="index">
                                <div class="card-body text-center">
                                    <h5>{{user.name}} {{user.surname}}</h5>
                                    <p class="mb-2">{{user.email}}</p>
                                    <p class="m-0">{{user.company}}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-sm btn-success" @click="grantAccess(index)">Grant Access</button>
                                    <button class="btn btn-sm btn-danger" @click="denyAccess(index)">Deny &amp; Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'grant-access',
    props: ['users'],
    data() {
        return {
            usersCopy: []
        }
    },
    mounted() {
        this.usersCopy = this.users;
    },
    methods: {
        grantAccess(index) {
            axios.post('/grant-access/' + this.usersCopy[index].id).then(response=>{
                console.log(response);
                this.usersCopy.splice(index, 1);
            }).catch(error=>{
                console.log(error);
            })
        },
        denyAccess(index) {
            axios.post('/deny-access/' + this.usersCopy[index].id).then(response=>{
                console.log(response);
                this.usersCopy.splice(index, 1);
            }).catch(error=>{
                console.log(error);
            })
        }
    }

}
</script>