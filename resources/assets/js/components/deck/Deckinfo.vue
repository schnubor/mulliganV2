<template>
    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
            <p class="heading">Colors</p>
            <p class="title">
                <template v-for="color in colors">
                    <span :key="color" class="ms ms-cost ms-fw manaicon" :class="`ms-${color.toLowerCase()}`"></span> 
                </template>
            </p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
            <p class="heading">Format</p>
            <p>
                <span class="tag is-success is-medium">{{ format }}</span>
            </p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
            <p class="heading">Tags</p>
            <p v-if="tags.length">
                <template v-for="tag in tags">
                    <span :key="tag" class="tag is-primary" style="margin: 0 2px;">{{ tag }}</span>
                </template>
            </p>
            <p class="title" v-else>
                <em>no tags</em>
            </p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Views</p>
                <p class="title">{{ views }}</p>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props : [ 'colors', 'format', 'tags', 'views' ]
};
</script>

