<template>
    <div class="d-flex">
        <button class="btn rounded-pill" @click="likePost" v-text="buttonText" style="background-color: orange; border:1px solid black;"></button>
    </div>
</template>

<script>
    export default {
        props:['post_id','liked'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return{
                status: this.liked,
            }
        },
        methods: {
            likePost(){
                axios.post('/like/'+this.post_id).then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                }).catch(errors => {
                    if(errors.response.status == 401){
                        window.location = '/login';
                    }
                });
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Unlike' : 'Like';
            }
        }
    }
</script>