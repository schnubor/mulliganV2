<template>
    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
            <p class="heading">Colors</p>
            <p class="title">
                <template v-for="color in colors">
                    <span class="ms ms-cost ms-fw manaicon" :class="`ms-${color.toLowerCase()}`"></span> 
                </template>
            </p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
            <p class="heading">Tags</p>
            <p v-if="tags.length">
                <template v-for="tag in tags">
                <span class="tag is-primary">{{ tag }}</span>
                </template>
            </p>
            <p class="title" v-else>
                <em>no tags</em>
            </p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Likes</p>
                <p class="title">{{ likes }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Comments</p>
                <p class="title">0</p>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props : [ 'colors', 'tags', 'likes' ]
};
</script>

