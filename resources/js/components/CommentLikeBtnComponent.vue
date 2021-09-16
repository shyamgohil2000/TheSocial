<template>
    <div class="d-flex">
        <button @click="likeOnComment" v-text="buttonText" class="btn rounded-pill" style="background-color: orange; border:1px solid black;"></button>
    </div>
</template>

<script>
    export default {
        props:['comment_id','likedoncomment'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return{
                status: this.likedoncomment,
            }
        },
        methods: {
            likeOnComment(){
                axios.post('/likeOnComment/'+this.comment_id).then(response => {
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