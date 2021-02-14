<template>
    <div class="container">
        <div class="row justify-content-center">
            <h1>ปาร์ตี้ทั้งหมด</h1>
            <router-link class="btn btn-link" to="/create-new-party">สร้างปาร์ตี้</router-link>
        </div>
        <div class="row">
            <div v-for="(party, index) in parties" :key="index" class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="logo.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{ party.name }}</p>
                        <div class="row">
                            <div class="col">
                                {{ party.members_count }} / {{ party.no_of_members }}
                            </div>
                            <div class="col">
                                <a class="btn btn-primary btn-block" :class="party.members_count == party.no_of_members || party.user_id == user_id ? 'disabled': ''" @click.prevent="joinParty(party.id, index)">Join</a>
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
        data() {
            return {
                parties: {},
                user_id: localStorage.getItem('user_id'),
            }
        },
        mounted() {
            console.log('Component mounted.')
            axios.get('/api/parties').then(response => {
                // console.log(response.data.data);
                this.parties = response.data.data
            }).catch(error => {
                console.log(error)
            })
        },
        methods: {
            joinParty(id, index) {
                console.log('id => ' + id)
                console.log('user_id => ' + localStorage.getItem('user_id'))
                axios.post('/api/members', {
                    party_id: id,
                    user_id: localStorage.getItem('user_id'),
                }).then(response => {
                    alert(response.data.message)
                    this.parties[index].members_count += 1
                    console.log(response.data)
                }).catch(error => {
                    console.log(error)
                })
            }
        },
    }
</script>
