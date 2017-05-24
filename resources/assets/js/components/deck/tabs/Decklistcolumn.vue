<template>
    <div class="column is-one-quarter">
        <aside class="menu">
            <p class="menu-label">
                {{ title }}
            </p>
            <ul class="menu-list">
                <template v-if="list.length">
                    <li v-for="item in list">
                        <a>
                            <span class="tag">{{ item.qty }}</span>
                            {{ item.card.name }}
                        </a>
                    </li>
                </template>
                <li v-else><em>No {{ title }}.</em></li>
            </ul>
        </aside>
    </div>
</template>

<script>
export default {
    props : [ 'title', 'list' ]
};
</script>
