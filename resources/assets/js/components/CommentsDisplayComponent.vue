<template>
    <div>
        HI
        <div v-for="comment in comments">
            <p>{{ comment.body }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
        data: function(){
            return {
                comments: []
            };
        },
        mounted: function() {
            this.getComments();
        },
        methods: {
            getComments: function() {
                axios.get('/posts/'+this.post+'/comments')
                    .then(response => {
                        this.comments = response.data;
                    })
            }
        }
    }
</script>
