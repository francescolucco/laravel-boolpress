<template>
    <div class="container">
        <div class="card">
            <div class="match-title">{{ post.title }}</div>
            <div class="date">{{ formatData }}</div>

            <div class="category_tags">
                <div class="category">{{ post.category.name }}</div>
                <div class="post_tags">
                    <div
                        class="tags"
                        v-for="(tag, index) in post.tags"
                        :key="`tag${index}`"
                    >
                        {{ tag.name }}
                    </div>
                </div>
            </div>

            <div class="description">
                <strong>Cronaca della partita:</strong><br />
                {{ post.description }}
            </div>
            <span><router-link :to="{name: 'home'}">Torna ai post</router-link></span>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostDetails",

    data() {
        return {
            slugPost: "",
            apiUrl: "http://127.0.0.1:8000/api/posts/",
            post: {
                title: "",
                date: "",
                description: "",
                category: {},
                tags: [],
            },
        };
    },

    computed: {
        // stringShrinkage() {
        //     return this.post.description.substring(0, 40) + "...";
        // },
        formatData() {
            const d = new Date(this.post.created_at);
            let day = d.getDate();
            let month = d.getMonth();
            let year = d.getFullYear();
            if (day < 10) day = "0" + day;
            if (month < 10) month = "0" + month;
            return `${day}/${month}/${year}`;
        },
    },

    methods: {
        getPostDetails() {
            axios.get(this.apiUrl + this.slugPost).then((res) => {
                this.post = res.data;
                console.log(this.post);
            });
        },
    },
    mounted() {
        this.slugPost = this.$route.params.slug;
        console.log(this.$route.params.slug);
        this.getPostDetails();
    },
};
</script>

<style lang="scss" scoped>
.container {
    margin: auto;
    padding: 130px 0 50px 0;
    min-height: calc(100vh + 80px);

    .card {
        margin: 40px 0;
        padding: 15px;
        border-radius: 5px;
        border: 2px solid rgba(0, 46, 113, 0);
        &:hover {
            color: rgba(1, 46, 113, 255);
            border: 2px solid rgba(1, 46, 113, 255);
            cursor: pointer;
        }
        .match-title {
            text-transform: uppercase;
            font-size: 20px;
            font-weight: bold;
            padding-bottom: 5px;
        }
        .date {
            font-size: 12px;
            font-style: italic;
        }
        .description {
            padding-top: 10px;
        }
        .category_tags {
            display: flex;
            padding: 5px 0;

            .category {
                border: 2px solid rgba(1, 46, 113, 255);
                color: rgba(1, 46, 113, 255);
                padding: 10px 15px;
                font-size: 11px;
                margin: 0 6px 0 0;
                border-radius: 20px;
            }
            .post_tags {
                display: flex;
                padding: 5px 0;
                .tags {
                    padding: 5px 10px;
                    font-size: 11px;
                    margin: 0 6px 0 0;
                    border-radius: 20px;
                    background-color: rgba(1, 46, 113, 255);
                    color: yellow;
                }
            }
        }
        span {
            margin-top: 20px;
            padding: 5px 10px;
            border-radius: 15px;
            background-color: rgb(255, 0, 0);
            color: rgb(245, 245, 253);
            display: inline-block;
            margin-bottom: 7px;
            &:hover {
                cursor: pointer;
                background-color: goldenrod;
            }
            a{
                color: white;
                text-decoration: none;
            }
        }
    }
}
</style>
