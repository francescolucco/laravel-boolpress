<template>
    <main>
        <div class="container">
            <h1>HELLAS VERONA</h1>
            <div v-if="posts">
                <PostItem
                    v-for="post in posts"
                    :key="`postItame${post.id}`"
                    :post="post"
                />

                <div class="button">
                    <button
                        @click="getPosts(pagination.current - 1)"
                        :disabled="pagination.current === 1"
                    >
                        Back
                    </button>
                    <button
                        v-for="i in pagination.last"
                        :key="`button${i}`"
                        @click="getPosts(i)"
                        :disabled="pagination.current === i"
                        :class="pagination.current === i ? 'active' : ''"
                    >
                        {{ i }}
                    </button>
                    <button
                        @click="getPosts(pagination.current + 1)"
                        :disabled="pagination.current === pagination.last"
                    >
                        Back
                    </button>
                </div>
            </div>
            <div v-else class="loading">
                <div class="add_loader">
                    <div id="guscioloader" class="guscioloader">
                        <div class="loader"></div>
                        <br />&nbsp;HELLA VERONA <br />Loading...
                    </div>
                    <a href="" onclick="loader();"></a>
                </div>
            </div>
            <div v-show="apiFailed">
                <h3>Errore: Pagina non trovata</h3>
            </div>
        </div>
    </main>
</template>

<script>
import PostItem from "../page/PostItem.vue";

export default {
    name: "Posts",

    components: {
        PostItem,
    },

    data() {
        return {
            apiUrl: "http://127.0.0.1:8000/api/posts?page=",
            posts: null,
            pagination: {},
            apiFailed: false,
        };
    },
    mounted() {
        this.getPosts();
        this.loader();
    },
    methods: {
        getPosts(page = 1) {
            console.log("page", page);
            this.posts = null;
            axios
                .get(this.apiUrl + page)
                .then((res) => {
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
                    };
                    console.log(this.pagination);
                })
                .catch((err) => {
                    // Request Failed!
                    this.apiFailed = true;
                    console.log("CHIAMATA FALLITA!");
                    console.log(err);
                });
        },
        loader() {
            document.getElementById("guscioloader").style.display = "flex";
        },
    },
};
</script>

<style lang="scss" scoped>
main {
    padding: 130px 0 50px 0;
    background-color: yellow;
    min-height: calc(100vh + 80px);
    h1 {
        text-align: center;
        font-size: 40px;
        color: rgba(1, 46, 113, 255);
    }
    .button {
        display: flex;
        justify-content: space-between;
        button {
            padding: 6px;
            border-radius: 5px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
                sans-serif;
            background-color: rgba(1, 46, 113, 255);
            color: yellow;
            font-weight: bold;
            &.active {
                background-color: yellow;
                color: rgba(1, 46, 113, 255);
            }
        }
    }
    .guscioloader {
        font-size: 1.6em;
        color: rgba(1, 46, 113, 255);
        font-weight: bold;
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: yellow;
        filter: alpha(opacity=80);
        -moz-opacity: 0.8;
        -khtml-opacity: 0.8;
        opacity: 0.8;
        text-align: center;
        align-items: center;
        justify-content: center;
    }
    .loader {
        border: 16px solid #f3f3f3;
        border-top: 16px solid rgba(1, 46, 113, 255);
        border-radius: 50%;
        width: 150px;
        height: 150px;
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
}
</style>
