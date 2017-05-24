<template>
    <section class="section">
        <div class="container">
            <div class="tabs">
                <ul>
                    <li class="is-active"><a>Decklist</a></li>
                    <li><a>Statistics</a></li>
                    <li><a>Visual Spoiler</a></li>
                    <li><a>Start Hand</a></li>
                </ul>
            </div>
                
            <Decklist v-if="activeTab === 'decklist'"></Decklist>
        </div>
    </section>
</template>

<script>
import Decklist from './tabs/Decklist.vue';

export default {
    components : {
        Decklist
    },
    data() {
        return {
            activeTab : 'decklist'
        };
    }
};
</script>

