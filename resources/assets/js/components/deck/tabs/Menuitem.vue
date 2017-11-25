<template>
    <div>
        <p class="menu-label">
            {{headline}}
        </p>
        <ul class="menu-list">
            <li v-for="item in cards" :key="item.card.name">
                <a @click="showCardModal(item.card)">
                    <span class="tag">{{ item.qty }}</span>
                    {{ item.card.name }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: [ 'headline', 'cards' ]
}
</script>
