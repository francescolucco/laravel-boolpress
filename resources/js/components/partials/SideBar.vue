<template>
    <div class="sidebar">
        <div class="box">
            <h2>Categorie</h2>
            <div class="categorie">
                <span
                    v-for="category in categories"
                    :key="`cat${category.id}`"
                    @click="$emit('getPostsCategoty', category.slug)"
                    >{{ category.name }}</span
                >
            </div>
        </div>
        <div class="box">
            <h2>Tags</h2>
            <div class="tag">
                <span
                    v-for="(tag, index) in tags"
                    :key="`tag${index}`"
                    @click="$emit('getPostsTag', tag.slug)"
                    >{{ tag.name }}</span
                >
            </div>
        </div>
        <span
        @click="$emit('getListPosts')"
        >Torna ai post</span>
    </div>
</template>

<script>
export default {
    name: "SideBar",

    props: {
        tags: Array,
        categories: Array,
    },
};
</script>

<style lang="scss" scoped>
.sidebar {
    width: 25%;
    margin-top: 100px;
    .box {
        padding: 30px 15px;
        border: 2px solid blue;
        margin-bottom: 20px;
        border-radius: 10px;
        h2 {
            margin-bottom: 10px;
        }
        span {
            padding: 5px 10px;
            border-radius: 15px;
            background-color: yellow;
            color: blue;
            display: inline-block;
            margin-bottom: 7px;
            &:hover {
                cursor: pointer;
                background-color: goldenrod;
            }
        }
        .tag {
            span {
                background-color: yellowgreen;
                &:hover {
                    cursor: pointer;
                    background-color: goldenrod;
                }
            }
        }
    }
    span {
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
    }
}
</style>
