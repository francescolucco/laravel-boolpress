<template>
    <div class="container container-posts">
        <div class="posts-box">
            <div v-if="success">
                <div v-if="posts">
                    <h1>{{ title }}</h1>
                    <PostItem
                        v-for="post in posts"
                        :key="`postItame${post.id}`"
                        :post="post"
                    />

                    <div class="buttons-box">
                        <div v-if="globalPosts">
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
                                :class="
                                    pagination.current === i ? 'active' : ''
                                "
                            >
                                {{ i }}
                            </button>
                            <button
                                @click="getPosts(pagination.current + 1)"
                                :disabled="
                                    pagination.current === pagination.last
                                "
                            >
                                Back
                            </button>
                        </div>
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
            </div>
            <div v-else>
                <div>
                    <h1>{{ error_msg }}</h1>
                </div>
            </div>
        </div>

        <SideBar
            :tags="tags"
            :categories="categories"
            @getPostsCategoty="getPostsCategoty"
            @getPostsTag="getPostsTag"
            @getListPosts="getPosts"
        />
    </div>
</template>

<script>
import PostItem from "../page/PostItem.vue";
import SideBar from "../partials/SideBar.vue";

export default {
    name: "Posts",

    components: {
        PostItem,
        SideBar,
    },

    data() {
        return {
            apiUrl: "http://127.0.0.1:8000/api/posts",
            posts: null,
            pagination: {},
            apiFailed: false,
            tags: [],
            categories: [],
            title: "HELLAS VERONA",
            success: true,
            error_msg: "",
            globalPosts: true,
        };
    },
    mounted() {
        this.getPosts();
        this.loader();
    },
    methods: {
        getPostsCategoty(slug_category) {
            this.resetData();
            axios
                .get(this.apiUrl + "/postcategory/" + slug_category)
                .then((res) => {
                    this.posts = res.data.category.posts;
                    this.globalPosts = false;
                    this.title =
                        "I miei post per la categoria: " +
                        res.data.category.name;
                    if (!res.data.success) {
                        this.error_msg = res.data.error;
                        this.success = false;
                    }
                });
        },
        getPostsTag(tag_category) {
            this.resetData();
            axios.get(this.apiUrl + "/posttag/" + tag_category).then((res) => {
                this.posts = res.data.tag.posts;
                this.globalPosts = false;
                this.title =
                    "I miei post per la categoria: " + res.data.tag.name;
                if (!res.data.success) {
                    this.error_msg = res.data.error;
                    this.success = false;
                }
            });
        },
        getPosts(page = 1) {
            console.log("page", page);
            this.resetData();
            this.apiFailed = false;
            axios
                .get(this.apiUrl + "?page=" + page)
                .then((res) => {
                    // console.log(res.data);
                    this.posts = res.data.posts.data;
                    this.tags = res.data.tags;
                    this.categories = res.data.categories;
                    this.pagination = {
                        current: res.data.posts.current_page,
                        last: res.data.posts.last_page,
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
        resetData() {
            (this.success = true), (this.error_msg = ""), (this.posts = null);
            this.title = "HELLAS VERONA";
            this.globalPosts = true;
        },
    },
};
</script>

<style lang="scss" scoped>
.container-posts {
    display: flex;
    .posts-box {
        width: 75%;
        h1 {
            text-align: center;
            font-size: 40px;
            color: rgba(1, 46, 113, 255);
        }
        .buttons-box {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            button {
                padding: 6px;
                border-radius: 5px;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                    Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans",
                    "Helvetica Neue", sans-serif;
                background-color: rgba(1, 46, 113, 255);
                color: yellow;
                font-weight: bold;
                font-size: 10px;
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
            // background: yellow;
            filter: alpha(opacity=80);
            -moz-opacity: 0.8;
            -khtml-opacity: 0.8;
            opacity: 0.8;
            text-align: center;
            align-items: center;
            justify-content: center;
        }
        .loader {
            border: 16px solid yellow;
            // border: 16px solid #f3f3f3;
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
}
</style>
