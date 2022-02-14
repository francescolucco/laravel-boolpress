<template>
    <div class="card">
        <!-- <a class="match-title">{{ post.id }}) {{ post.title }}</a>
        ricordiamoci che name dentro router-link è un oggetto. Dopo aver inserito il name metto quindi la virgola (perchè è un oggetto) passo la proprietà params, la quale a sua volta è un oggetto :{} con i parameteri che io gli passo (possono essere più di uno), in questo caso passo lo slug che corrisponde a post.slug -->
        <router-link  class="match-title" :to="{name: 'postDetails', params:{slug: post.slug} }">{{ post.id }}) {{ post.title }}</router-link>
        <div class="date">Data del match: {{ formatData }}</div>

        <div class="category_tags">
            <div v-if="post.category" class="category">
                {{ post.category.name }}
            </div>
            <div class="post_tags" v-if="post.tags">
                <div
                    class="tags"
                    v-for="(tag, index) in post.tags"
                    :key="`post_category${index}`"
                >
                    {{ tag.name }}
                </div>
            </div>
        </div>

        <div class="description">
            <strong>Cronaca della partita:</strong><br />
            {{ stringShrinkage }}
        </div>
    </div>
</template>

<script>
export default {
    name: "PostItem",

    props: {
        post: Object,
    },
    computed: {
        stringShrinkage() {
            return this.post.description.substring(0, 140) + "...";
        },
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

    methods: {},
};
</script>

<style lang="scss" scoped>
.card {
    margin: 40px 0;
    padding: 15px;
    border-radius: 5px;
    border: 2px solid rgba(0, 46, 113, 0);
    margin-right: 25px;
    &:hover {
        color: rgba(1, 46, 113, 255);
        border: 2px solid  rgb(109, 107, 5);
        cursor: pointer;
    }
    .match-title {
        text-transform: uppercase;
        font-size: 20px;
        font-weight: bold;
        padding-bottom: 5px;
        text-decoration: none;
        color: rgba(1, 46, 113, 255);
        &:hover{
            color: rgb(109, 107, 5);
        }
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
}
</style>
